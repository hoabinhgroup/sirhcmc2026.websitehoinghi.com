<?php

namespace App\Services;

use Carbon\Carbon;

class FeeCalculationService
{
    /**
     * @return array{
     *     price_period: string,
     *     base_fee: int,
     *     gala_fee: int,
     *     subtotal: int,
     *     transaction_fee: int,
     *     total: int,
     *     fee_waiver: bool
     * }
     */
    public function calculate(
        string $delegateCategory,
        bool $galaDinner,
        ?string $paymentMethod = null,
        ?Carbon $paymentDate = null,
    ): array {
        $paymentDate = $paymentDate ?? Carbon::now('Asia/Bangkok');
        $pricePeriod = $this->resolvePricePeriod($paymentDate);
        $feeConfig = config("registration.fees.{$delegateCategory}", []);
        $baseFee = (int) data_get($feeConfig, $pricePeriod, 0);
        $feeWaiver = (bool) data_get($feeConfig, 'fee_waiver', false);
        $galaFee = $galaDinner ? (int) config('registration.galadinner_fee', 0) : 0;
        $subtotal = $baseFee + $galaFee;
        $transactionFee = $this->calculateTransactionFee($subtotal, $paymentMethod);
        $total = $subtotal + $transactionFee;

        return [
            'price_period' => $pricePeriod,
            'base_fee' => $baseFee,
            'gala_fee' => $galaFee,
            'subtotal' => $subtotal,
            'transaction_fee' => $transactionFee,
            'total' => $total,
            'fee_waiver' => $feeWaiver && $baseFee === 0,
        ];
    }

    public function resolvePricePeriod(Carbon $paymentDate): string
    {
        $earlyDeadline = Carbon::parse(
            config('registration.early_deadline'),
            'Asia/Bangkok'
        )->endOfDay();

        return $paymentDate->lte($earlyDeadline) ? 'early' : 'standard';
    }

    public function getDisplayFee(string $delegateCategory, ?Carbon $referenceDate = null): int
    {
        $referenceDate = $referenceDate ?? Carbon::now('Asia/Bangkok');
        $pricePeriod = $this->resolvePricePeriod($referenceDate);

        return (int) data_get(config("registration.fees.{$delegateCategory}"), $pricePeriod, 0);
    }

    private function calculateTransactionFee(int $subtotal, ?string $paymentMethod): int
    {
        if ($subtotal <= 0 || $paymentMethod !== 'onepay') {
            return 0;
        }

        $percent = (int) config('registration.online_transaction_fee_percent', 6);

        return (int) round($subtotal * $percent / 100);
    }
}
