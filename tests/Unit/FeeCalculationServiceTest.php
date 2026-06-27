<?php

namespace Tests\Unit;

use App\Services\FeeCalculationService;
use Carbon\Carbon;
use Tests\TestCase;

class FeeCalculationServiceTest extends TestCase
{
    public function test_early_bird_physician_fee(): void
    {
        $service = new FeeCalculationService;

        $fees = $service->calculate(
            'physician',
            false,
            'bank-transfer',
            Carbon::parse('2026-09-10', 'Asia/Bangkok'),
        );

        $this->assertSame('early', $fees['price_period']);
        $this->assertSame(1_000_000, $fees['base_fee']);
        $this->assertSame(0, $fees['transaction_fee']);
        $this->assertSame(1_000_000, $fees['total']);
    }

    public function test_standard_physician_fee_with_gala_and_online_fee(): void
    {
        $service = new FeeCalculationService;

        $fees = $service->calculate(
            'physician',
            true,
            'onepay',
            Carbon::parse('2026-09-20', 'Asia/Bangkok'),
        );

        $this->assertSame('standard', $fees['price_period']);
        $this->assertSame(2_000_000, $fees['base_fee']);
        $this->assertSame(800_000, $fees['gala_fee']);
        $this->assertSame(168_000, $fees['transaction_fee']);
        $this->assertSame(2_968_000, $fees['total']);
    }

    public function test_fee_waiver_category(): void
    {
        $service = new FeeCalculationService;

        $fees = $service->calculate('sirhcm_member', false, null);

        $this->assertSame(0, $fees['total']);
        $this->assertTrue($fees['fee_waiver']);
    }
}
