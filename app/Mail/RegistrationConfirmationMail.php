<?php

namespace App\Mail;

use App\Models\Registration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegistrationConfirmationMail extends Mailable
{
    use Queueable, SerializesModels, UsesConferenceMailEnvelope;

    /**
     * @param  array<string, mixed>  $bank
     */
    public function __construct(
        public Registration $registration,
        public ?string $paymentLink = null,
        public array $bank = [],
        public string $transferContent = '',
    ) {
        $this->bank = $bank ?: config('registration.bank_transfer', []);
        $this->transferContent = $transferContent ?: $this->resolveTransferContent();
    }

    public function envelope(): Envelope
    {
        return $this->conferenceEnvelope($this->registration->email_subject);
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.registration.confirmation',
        );
    }

    private function resolveTransferContent(): string
    {
        return str_replace(
            ['{guest_code}', '{fullname}'],
            [$this->registration->guest_code, $this->registration->fullname],
            $this->bank['content_template'] ?? '',
        );
    }
}
