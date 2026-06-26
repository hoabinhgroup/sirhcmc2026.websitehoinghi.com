<?php

namespace App\Services;

use App\Mail\RegistrationConfirmationMail;
use App\Models\Registration;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class RegistrationEmailService
{
    public function send(Registration $registration, ?string $paymentLink = null): void
    {
        $mailable = new RegistrationConfirmationMail($registration, $paymentLink);

        if (config('registration.email.use_api')) {
            $this->sendViaApi($registration, $mailable->render());

            return;
        }

        Mail::to($registration->email)->send($mailable);
    }

    private function sendViaApi(Registration $registration, string $html): void
    {
        Http::post(config('registration.email.endpoint'), [
            'sending_server' => config('registration.email.sending_server'),
            'email' => $registration->email,
            'from_email' => config('registration.email.from_email'),
            'from_name' => config('registration.email.from_name'),
            'subject' => $registration->email_subject,
            'reply_to' => config('registration.email.reply_to'),
            'addCC' => config('registration.email.cc'),
            'template' => $html,
        ]);
    }
}
