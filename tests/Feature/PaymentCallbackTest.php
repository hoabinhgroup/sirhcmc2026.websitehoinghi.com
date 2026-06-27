<?php

namespace Tests\Feature;

use App\Events\PaymentSuccessNotification;
use App\Mail\RegistrationTemplateMail;
use App\Models\Registration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class PaymentCallbackTest extends TestCase
{
    use RefreshDatabase;

    public function test_payment_success_event_sends_email_and_logs(): void
    {
        Mail::fake();

        $registration = Registration::query()->create([
            'guest_code' => 'SIRHCM26-R0100',
            'title' => 'BS.',
            'fullname' => 'Pay Success',
            'affiliation' => 'BV Test',
            'email' => 'success@example.com',
            'conference_fees' => json_encode(['physician']),
            'base_fee' => 1000000,
            'gala_fee_amount' => 0,
            'transaction_fee' => 60000,
            'total' => 1060000,
            'payment_method' => 'onepay',
            'status' => 'confirmed',
            'is_international' => false,
        ]);

        event(new PaymentSuccessNotification($registration));

        Mail::assertSent(RegistrationTemplateMail::class, function (RegistrationTemplateMail $mail): bool {
            return $mail->templateKey === 'payment_success'
                && $mail->registration->email === 'success@example.com';
        });

        $this->assertDatabaseHas('email_logs', [
            'owner_type' => Registration::class,
            'owner_id' => $registration->id,
            'template_key' => 'payment_success',
            'recipient_email' => 'success@example.com',
            'status' => 'sent',
        ]);
    }
}
