<?php

namespace Tests\Unit;

use App\Mail\RegistrationConfirmationMail;
use App\Models\Registration;
use Tests\TestCase;

class RegistrationConfirmationMailTest extends TestCase
{
    public function test_mailable_renders_registration_details(): void
    {
        $registration = new Registration([
            'guest_code' => 'SIRHCM2026-001',
            'title' => 'BS.',
            'fullname' => 'Nguyen Van A',
            'affiliation' => 'BV Cho Ray',
            'email' => 'test@example.com',
            'conference_fees' => '["sirhcm_member"]',
            'total' => 2500000,
            'payment_method' => 'bank-transfer',
            'status' => 'pending',
            'is_international' => false,
        ]);

        $html = (new RegistrationConfirmationMail($registration))->render();

        $this->assertStringContainsString('SIRHCM2026-001', $html);
        $this->assertStringContainsString('Nguyen Van A', $html);
        $this->assertStringContainsString('sirhcm2024@gmail.com', $html);
        $this->assertStringNotContainsString('Thông tin chuyển khoản', $html);
        $this->assertStringNotContainsString('Thanh toán online qua OnePay', $html);
    }

    public function test_mailable_does_not_include_payment_link_for_onepay(): void
    {
        $registration = new Registration([
            'guest_code' => 'SIRHCM2026-002',
            'title' => 'TS.',
            'fullname' => 'Tran Thi B',
            'affiliation' => 'BV A',
            'email' => 'onepay@example.com',
            'conference_fees' => '["sirhcm_member"]',
            'total' => 2500000,
            'payment_method' => 'onepay-payment',
            'status' => 'pending',
            'is_international' => false,
        ]);

        $html = (new RegistrationConfirmationMail($registration, 'https://onepay.test/pay'))->render();

        $this->assertStringNotContainsString('https://onepay.test/pay', $html);
        $this->assertStringNotContainsString('Thanh toán online qua OnePay', $html);
    }
}
