<?php

namespace Tests\Feature;

use App\Mail\AbstractReceivedMail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AbstractSubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_abstract_form_loads(): void
    {
        config(['abstract.submission_deadline' => '2099-12-31 23:59:59']);

        $response = $this->get(route('registration.abstract-submission'));

        $response->assertOk();
        $response->assertSee('Nộp bài báo cáo tóm tắt');
    }

    public function test_domestic_abstract_submission_creates_record(): void
    {
        Mail::fake();
        Storage::fake('public');
        config(['abstract.submission_deadline' => '2099-12-31 23:59:59']);

        $response = $this->post(route('registration.abstract-submission.submit'), [
            'scope' => 'domestic',
            'abstract_category' => 'artificial_intelligence',
            'title' => 'BS.',
            'fullname' => 'Tran Van C',
            'affiliation' => 'BV Cho Ray',
            'day' => 1,
            'month' => 1,
            'year' => 1985,
            'citizen_id' => '123456789012',
            'phone' => '0901234567',
            'email' => 'abstract@example.com',
            'abstract_file' => UploadedFile::fake()->create('abstract.pdf', 100, 'application/pdf'),
            'cv_file' => UploadedFile::fake()->create('cv.pdf', 100, 'application/pdf'),
            'headshot_file' => UploadedFile::fake()->create('photo.jpg', 100, 'image/jpeg'),
            'degree_file' => UploadedFile::fake()->create('degree.pdf', 100, 'application/pdf'),
        ]);

        $response->assertOk();
        $response->assertSee('SIRHCM26-A0001');

        $this->assertDatabaseHas('abstract_submissions', [
            'email' => 'abstract@example.com',
            'submission_code' => 'SIRHCM26-A0001',
            'status' => 'submitted',
        ]);

        Mail::assertSent(AbstractReceivedMail::class, 1);
    }

    public function test_abstract_closed_when_deadline_passed(): void
    {
        config(['abstract.submission_deadline' => '2020-01-01 00:00:00']);

        $response = $this->get(route('registration.abstract-submission'));

        $response->assertRedirect(route('registration.abstract-submission.closed'));
    }
}
