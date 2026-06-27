<?php

namespace App\Services;

use App\Enums\PaymentStatus;
use App\Models\Registration;
use Illuminate\Support\Arr;

class OnepayService
{
    public function resolveMerchantKey(?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();

        if (config('payment.default_merchant')) {
            $configured = (string) config('payment.default_merchant');

            if ($configured !== 'auto') {
                return $configured;
            }
        }

        return $locale === 'en' ? 'international' : 'international_vnd';
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function resolveMerchantKeyFromPayload(array $payload): ?string
    {
        $merchantId = (string) Arr::get($payload, 'vpc_Merchant', '');

        if ($merchantId === '') {
            return null;
        }

        foreach (config('payment.merchants', []) as $key => $config) {
            if (($config['vpc_Merchant'] ?? '') === $merchantId) {
                return $key;
            }
        }

        return null;
    }

    public function buildPaymentLink(Registration $registration, string $returnUrl, ?string $merchantKey = null): string
    {
        $merchantKey = $merchantKey ?? $this->resolveMerchantKey($registration->locale);
        $config = $this->merchantConfig($merchantKey);
        $amount = $this->amountWithTax($registration);

        $params = [
            'vpc_Merchant' => $config['vpc_Merchant'] ?? '',
            'vpc_AccessCode' => $config['vpc_AccessCode'] ?? '',
            'vpc_MerchTxnRef' => $registration->guest_code.'_'.time(),
            'vpc_OrderInfo' => $registration->guest_code,
            'vpc_Amount' => $amount * 100,
            'vpc_ReturnURL' => $returnUrl,
            'vpc_Version' => '2',
            'vpc_Command' => 'pay',
            'vpc_Locale' => 'vn',
        ];

        $secureSecret = (string) ($config['SECURE_SECRET'] ?? '');
        $secureHash = $this->createSecureHash($params, $secureSecret);
        $gatewayUrl = $config['gateway_url'] ?? 'https://mtf.onepay.vn/paygate/vpcpay.op';
        $hashData = $this->buildHashData($params);

        return $gatewayUrl.'?'.$hashData.'&vpc_SecureHash='.$secureHash;
    }

    /**
     * @param  array<string, mixed>  $payload
     * @return array{status: string, route: string, hash_valid: bool, txn_response_code: string}
     */
    public function handleResponse(array $payload, ?string $merchantKey = null): array
    {
        $merchantKey = $merchantKey
            ?? $this->resolveMerchantKeyFromPayload($payload)
            ?? $this->resolveMerchantKey();

        $config = $this->merchantConfig($merchantKey);
        $hashValid = $this->verifySecureHash($payload, (string) ($config['SECURE_SECRET'] ?? ''));
        $txnCode = (string) Arr::get($payload, 'vpc_TxnResponseCode', '');

        $status = $this->resolvePaymentStatus($hashValid, $txnCode);

        return [
            'status' => $status->value,
            'route' => match ($status) {
                PaymentStatus::Successful => 'registration.payment.success',
                PaymentStatus::Cancelled => 'registration.payment.cancel',
                default => 'registration.payment.error',
            },
            'hash_valid' => $hashValid,
            'txn_response_code' => $txnCode,
        ];
    }

    public function amountWithTax(Registration $registration): int
    {
        if ((float) $registration->transaction_fee > 0) {
            return (int) round((float) $registration->total);
        }

        $subtotal = (float) $registration->base_fee + (float) $registration->gala_fee_amount;

        if ($subtotal > 0) {
            $taxRate = (float) config('payment.onepay_tax_rate', 0.06);

            return (int) round($subtotal * (1 + $taxRate));
        }

        $taxRate = (float) config('payment.onepay_tax_rate', 0.06);

        return (int) round((float) $registration->total * (1 + $taxRate));
    }

    public function expectedVpcAmount(Registration $registration): int
    {
        return $this->amountWithTax($registration) * 100;
    }

    public function verifyAmount(Registration $registration, array $payload): bool
    {
        $received = (int) Arr::get($payload, 'vpc_Amount', 0);

        return $received === $this->expectedVpcAmount($registration);
    }

    public static function responseDescription(?string $code): string
    {
        return match ($code) {
            '0' => 'successful',
            '1' => 'Bank Declined',
            '2' => 'pending',
            '3' => 'Merchant not exist',
            '4' => 'Invalid access code',
            '5' => 'Invalid amount',
            '6' => 'Invalid currency code',
            '7' => 'Unspecified Failure',
            '21' => 'Insufficient fund',
            '99' => 'cancelled',
            default => 'failed',
        };
    }


    /**
     * @param  array<string, mixed>  $params
     */
    private function createSecureHash(array $params, string $secureSecret): string
    {
        return strtoupper(hash_hmac('SHA256', $this->buildHashData($params), pack('H*', $secureSecret)));
    }

    /**
     * OnePay: ksort alphabetically, only vpc_/user_ keys, non-empty values, raw (no URL encode).
     *
     * @param  array<string, mixed>  $params
     */
    private function buildHashData(array $params): string
    {
        $hashParams = [];

        foreach ($params as $key => $value) {
            if (in_array($key, ['vpc_SecureHash', 'vpc_SecureHashType'], true)) {
                continue;
            }

            if (! str_starts_with($key, 'vpc_') && ! str_starts_with($key, 'user_')) {
                continue;
            }

            $value = (string) $value;

            if ($value === '') {
                continue;
            }

            $hashParams[$key] = $value;
        }

        ksort($hashParams);

        $parts = [];
        foreach ($hashParams as $key => $value) {
            $parts[] = "{$key}={$value}";
        }

        return implode('&', $parts);
    }


    /**
     * @param  array<string, mixed>  $payload
     */
    private function verifySecureHash(array $payload, string $secureSecret): bool
    {
        $receivedHash = strtoupper((string) Arr::get($payload, 'vpc_SecureHash', ''));

        if ($receivedHash === '' || $secureSecret === '') {
            return false;
        }

        $calculatedHash = $this->createSecureHash($payload, $secureSecret);

        return hash_equals($calculatedHash, $receivedHash);
    }

    private function resolvePaymentStatus(bool $hashValid, string $txnCode): PaymentStatus
    {
        if ($hashValid && $txnCode === '0') {
            return PaymentStatus::Successful;
        }

        if (! $hashValid && $txnCode === '0') {
            return PaymentStatus::Pending;
        }

        return PaymentStatus::fromOnepayResponseCode($txnCode);
    }

    /**
     * @return array<string, mixed>
     */
    private function merchantConfig(string $merchantKey): array
    {
        return config("payment.merchants.{$merchantKey}", []);
    }
}
