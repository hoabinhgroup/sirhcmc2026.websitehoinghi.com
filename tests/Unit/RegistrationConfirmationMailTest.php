<?php

namespace Tests\Unit;

use App\Mail\RegistrationTemplateMail;
use App\Models\Registration;
use Tests\TestCase;

class RegistrationConfirmationMailTest extends TestCase
{
    public function test_bank_transfer_template_renders_details(): void
    {
        $registration = new Registration([
            'guest_code' => 'SIRHCM26-R0001',
            'title' => 'BS.',
            'fullname' => 'Nguyen Van A',
            'affiliation' => 'BV Cho Ray',
            'email' => 'test@example.com',
            'conference_fees' => '["physician"]',
            'base_fee' => 1000000,
            'gala_fee_amount' => 0,
            'transaction_fee' => 0,
            'total' => 1000000,
            'payment_method' => 'bank-transfer',
            'status' => 'pending',
            'is_international' => false,
        ]);

        $html = (new RegistrationTemplateMail(
            $registration,
            'bank_transfer',
            'Test subject',
        ))->render();

        $this->assertStringContainsString('SIRHCM26-R0001', $html);
        $this->assertStringContainsString('Nguyen Van A', $html);
        $this->assertStringContainsString('1112 0846 228 011', $html);
        $this->assertStringContainsString('sirhcm2024@gmail.com', $html);
    }

    public function test_online_payment_template_includes_payment_link(): void
    {
        $registration = new Registration([
            'guest_code' => 'SIRHCM26-R0002',
            'title' => 'TS.',
            'fullname' => 'Tran Thi B',
            'affiliation' => 'BV A',
            'email' => 'onepay@example.com',
            'conference_fees' => '["physician"]',
            'base_fee' => 1000000,
            'gala_fee_amount' => 0,
            'transaction_fee' => 60000,
            'total' => 1060000,
            'payment_method' => 'onepay',
            'status' => 'pending',
            'is_international' => false,
        ]);

        $html = (new RegistrationTemplateMail(
            $registration,
            'online_payment',
            'Test subject',
            'https://onepay.test/pay',
        ))->render();

        $this->assertStringContainsString('https://onepay.test/pay', $html);
        $this->assertStringContainsString('Thanh toán OnePay', $html);
    }
}
