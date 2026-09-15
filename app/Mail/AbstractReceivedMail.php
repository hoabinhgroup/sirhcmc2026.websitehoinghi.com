<?php

namespace App\Mail;

use App\Models\AbstractSubmission;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AbstractReceivedMail extends Mailable
{
    use Queueable, SerializesModels, UsesConferenceMailEnvelope;

    public function __construct(
        public AbstractSubmission $submission,
    ) {}

    public function envelope(): Envelope
    {
        $subject = $this->submission->isDomestic()
            ? "Xác nhận nộp abstract SIRHCM 2026 – {$this->submission->submission_code}"
            : "SIRHCM 2026 Abstract Submission Received – {$this->submission->submission_code}";

        return $this->conferenceEnvelope($subject);
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.abstract.received',
        );
    }
}
