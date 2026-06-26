<?php

namespace App\Mail;

use App\Models\Registration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegistrationConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

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
        $cc = collect(config('registration.email.cc', []))
            ->filter(fn (array $item): bool => ! empty($item[0]))
            ->map(fn (array $item): Address => new Address($item[0], $item[1] ?? null))
            ->all();

        return new Envelope(
            from: new Address(
                config('registration.email.from_email'),
                config('registration.email.from_name'),
            ),
            replyTo: [
                new Address(config('registration.email.reply_to')),
            ],
            cc: $cc,
            subject: $this->registration->email_subject,
        );
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
