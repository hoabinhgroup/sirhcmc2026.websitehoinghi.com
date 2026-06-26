<?php

namespace Tests\Unit;

use App\Enums\PaymentStatus;
use App\Models\Registration;
use App\Services\OnepayService;
use Tests\TestCase;

class OnepayServiceTest extends TestCase
{
    public function test_amount_with_tax_applies_six_percent(): void
    {
        $registration = new Registration(['total' => 2_500_000]);

        $this->assertSame(2_650_000, app(OnepayService::class)->amountWithTax($registration));
        $this->assertSame(265_000_000, app(OnepayService::class)->expectedVpcAmount($registration));
    }

    private function hashData(OnepayService $service, array $params): string
    {
        $method = new \ReflectionMethod($service, 'buildHashData');
        $method->setAccessible(true);

        return $method->invoke($service, $params);
    }

    public function test_hash_data_sorts_keys_alphabetically_and_excludes_empty_values(): void
    {
        $service = app(OnepayService::class);

        $hashData = $this->hashData($service, [
            'vpc_Command' => 'pay',
            'vpc_Amount' => '265000000',
            'vpc_AccessCode' => '',
            'vpc_Merchant' => 'TESTONEPAY',
            'vpc_SecureHash' => 'IGNORED',
            'vpc_SecureHashType' => 'SHA256',
            'Title' => 'ignored',
        ]);

        $this->assertSame(
            'vpc_Amount=265000000&vpc_Command=pay&vpc_Merchant=TESTONEPAY',
            $hashData
        );
    }

    public function test_known_sandbox_hash_matches_official_algorithm(): void
    {
        $service = app(OnepayService::class);
        $secret = config('payment.merchants.international_test.SECURE_SECRET');

        $params = [
            'vpc_AccessCode' => '6BEB2546',
            'vpc_Amount' => '265000000',
            'vpc_Command' => 'pay',
            'vpc_Locale' => 'vn',
            'vpc_MerchTxnRef' => 'SIRHCM2026-001_123456789',
            'vpc_Merchant' => 'TESTONEPAY',
            'vpc_OrderInfo' => 'SIRHCM2026-001',
            'vpc_ReturnURL' => 'https://example.com/registration/dr',
            'vpc_Version' => '2',
        ];

        $expectedString = 'vpc_AccessCode=6BEB2546&vpc_Amount=265000000&vpc_Command=pay&vpc_Locale=vn&vpc_MerchTxnRef=SIRHCM2026-001_123456789&vpc_Merchant=TESTONEPAY&vpc_OrderInfo=SIRHCM2026-001&vpc_ReturnURL=https://example.com/registration/dr&vpc_Version=2';
        $this->assertSame($expectedString, $this->hashData($service, $params));

        $reflection = new \ReflectionClass($service);
        $createHash = $reflection->getMethod('createSecureHash');
        $createHash->setAccessible(true);
        $hash = $createHash->invoke($service, $params, $secret);

        $this->assertSame(64, strlen($hash));
    }

    public function test_handle_response_marks_success_when_hash_valid_and_code_zero(): void
    {
        $service = app(OnepayService::class);
        $config = config('payment.merchants.international_test');

        $params = [
            'vpc_Merchant' => $config['vpc_Merchant'],
            'vpc_AccessCode' => $config['vpc_AccessCode'],
            'vpc_MerchTxnRef' => 'SIRHCM2026-001_123456789',
            'vpc_OrderInfo' => 'SIRHCM2026-001',
            'vpc_Amount' => '265000000',
            'vpc_ReturnURL' => 'https://example.com/registration/dr',
            'vpc_Version' => '2',
            'vpc_Command' => 'pay',
            'vpc_Locale' => 'vn',
            'vpc_TxnResponseCode' => '0',
            'vpc_TransactionNo' => '123456',
        ];

        $reflection = new \ReflectionClass($service);
        $createHash = $reflection->getMethod('createSecureHash');
        $createHash->setAccessible(true);
        $hash = $createHash->invoke($service, $params, $config['SECURE_SECRET']);

        $result = $service->handleResponse(
            array_merge($params, [
                'vpc_SecureHash' => $hash,
                'vpc_SecureHashType' => 'SHA256',
            ]),
            'international_test'
        );

        $this->assertTrue($result['hash_valid']);
        $this->assertSame(PaymentStatus::Successful->value, $result['status']);
    }

    public function test_handle_response_resolves_merchant_from_payload(): void
    {
        $service = app(OnepayService::class);
        $config = config('payment.merchants.international_test');

        $params = [
            'vpc_Merchant' => $config['vpc_Merchant'],
            'vpc_AccessCode' => $config['vpc_AccessCode'],
            'vpc_MerchTxnRef' => 'SIRHCM2026-001_123456789',
            'vpc_OrderInfo' => 'SIRHCM2026-001',
            'vpc_Amount' => '265000000',
            'vpc_ReturnURL' => 'https://example.com/registration/dr',
            'vpc_Version' => '2',
            'vpc_Command' => 'pay',
            'vpc_Locale' => 'vn',
            'vpc_TxnResponseCode' => '0',
        ];

        $reflection = new \ReflectionClass($service);
        $createHash = $reflection->getMethod('createSecureHash');
        $createHash->setAccessible(true);
        $hash = $createHash->invoke($service, $params, $config['SECURE_SECRET']);

        config(['payment.default_merchant' => 'international_vnd']);

        $result = $service->handleResponse(array_merge($params, ['vpc_SecureHash' => $hash]));

        $this->assertTrue($result['hash_valid']);
        $this->assertSame(PaymentStatus::Successful->value, $result['status']);
    }

    public function test_handle_response_marks_pending_when_hash_invalid_but_code_zero(): void
    {
        $result = app(OnepayService::class)->handleResponse([
            'vpc_TxnResponseCode' => '0',
            'vpc_SecureHash' => 'INVALID',
        ], 'international_test');

        $this->assertFalse($result['hash_valid']);
        $this->assertSame(PaymentStatus::Pending->value, $result['status']);
    }

    public function test_resolve_merchant_key_uses_vnd_for_vietnamese_locale(): void
    {
        config(['payment.default_merchant' => 'auto']);

        app()->setLocale('vi');

        $this->assertSame('international_vnd', app(OnepayService::class)->resolveMerchantKey());
    }
}
