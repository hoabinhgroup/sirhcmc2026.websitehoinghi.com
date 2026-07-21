<?php

namespace Tests\Feature;

use App\Enums\PaymentMethod;
use App\Mail\AbstractReceivedMail;
use App\Mail\RegistrationTemplateMail;
use App\Models\AbstractSubmission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class RegistrationSubmitTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_form_page_loads(): void
    {
        $response = $this->get(route('registration.delegate-registration'));

        $response->assertOk();
        $response->assertSee('Đăng ký tham dự');
    }

    public function test_international_registration_form_loads(): void
    {
        $response = $this->get(route('registration.international-registration'));

        $response->assertOk();
        $response->assertSee('International Registration');
    }

    public function test_bank_transfer_registration_creates_record_and_sends_email(): void
    {
        Mail::fake();
        Storage::fake('local');

        $response = $this->post(route('registration.submit'), [
            'scope' => 'domestic',
            'title' => 'BS.',
            'fullname' => 'Nguyen Van A',
            'affiliation' => 'BV Cho Ray',
            'position' => 'BS',
            'day' => 1,
            'month' => 1,
            'year' => 1990,
            'phone' => '0901234567',
            'email' => 'test@example.com',
            'degree_file' => UploadedFile::fake()->create('degree.pdf', 100, 'application/pdf'),
            'conference_checklist_item' => 'physician',
            'payment_method' => 'bank-transfer',
            'country' => 'VN',
        ]);

        $response->assertOk();
        $response->assertSee('SIRHCM26-R0001');

        $this->assertDatabaseHas('registrations', [
            'email' => 'test@example.com',
            'guest_code' => 'SIRHCM26-R0001',
            'payment_method' => PaymentMethod::BankTransfer->value,
            'base_fee' => 1000000,
        ]);

        Mail::assertSent(RegistrationTemplateMail::class, 1);
    }

    public function test_fee_waiver_registration_skips_payment(): void
    {
        Mail::fake();
        Storage::fake('local');

        $response = $this->post(route('registration.submit'), [
            'scope' => 'domestic',
            'title' => 'BS.',
            'fullname' => 'Nguyen Van B',
            'affiliation' => 'BV Cho Ray',
            'day' => 1,
            'month' => 1,
            'year' => 1990,
            'phone' => '0901234567',
            'email' => 'waiver@example.com',
            'degree_file' => UploadedFile::fake()->create('degree.pdf', 100, 'application/pdf'),
            'conference_checklist_item' => 'plenary_invited',
            'country' => 'VN',
        ]);

        $response->assertOk();
        $response->assertSee('SIRHCM26-R0001');

        $this->assertDatabaseHas('registrations', [
            'email' => 'waiver@example.com',
            'total' => 0,
            'status' => 'confirmed',
            'payment_method' => null,
        ]);

        Mail::assertSent(RegistrationTemplateMail::class, 1);
    }

    public function test_closed_page_when_deadline_passed(): void
    {
        config(['registration.registration_deadline' => '2020-01-01 00:00:00']);

        $response = $this->get(route('registration.delegate-registration'));

        $response->assertRedirect(route('registration.closed'));
    }
}
