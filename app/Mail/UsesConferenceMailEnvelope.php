<?php

namespace App\Mail;

use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Envelope;

trait UsesConferenceMailEnvelope
{
    protected function conferenceEnvelope(string $subject): Envelope
    {
        return new Envelope(
            from: new Address(
                config('registration.email.from_email'),
                config('registration.email.from_name'),
            ),
            replyTo: [
                new Address(config('registration.email.reply_to')),
            ],
            cc: $this->conferenceAddresses('cc'),
            bcc: $this->conferenceAddresses('bcc'),
            subject: $subject,
        );
    }

    /**
     * @return array<int, Address>
     */
    protected function conferenceAddresses(string $type): array
    {
        return collect(config("registration.email.{$type}", []))
            ->map(function (array|string $item): ?Address {
                if (is_string($item)) {
                    return $item !== '' ? new Address($item) : null;
                }

                $email = $item[0] ?? null;

                if (! is_string($email) || $email === '') {
                    return null;
                }

                $name = $item[1] ?? null;

                return is_string($name) && $name !== ''
                    ? new Address($email, $name)
                    : new Address($email);
            })
            ->filter()
            ->values()
            ->all();
    }
}
