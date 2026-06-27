<?php

namespace App\Mail;

use App\Models\AbstractSubmission;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AbstractResultMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public AbstractSubmission $submission,
        public string $result,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(
                config('registration.email.from_email'),
                config('registration.email.from_name'),
            ),
            replyTo: [
                new Address(config('registration.email.reply_to')),
            ],
            subject: $this->resolveSubjectLine(),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.abstract.result',
        );
    }

    private function resolveSubjectLine(): string
    {
        $label = match ($this->result) {
            'accepted' => $this->submission->isDomestic() ? 'Chấp nhận' : 'Accepted',
            'rejected' => $this->submission->isDomestic() ? 'Không chấp nhận' : 'Not Accepted',
            default => $this->submission->isDomestic() ? 'Yêu cầu chỉnh sửa' : 'Revision Requested',
        };

        return $this->submission->isDomestic()
            ? "Kết quả abstract SIRHCM 2026 – {$label} – {$this->submission->submission_code}"
            : "SIRHCM 2026 Abstract Result – {$label} – {$this->submission->submission_code}";
    }
}
