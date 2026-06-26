<?php

namespace App\Listeners;

use App\Events\RegistrationNotification;
use App\Services\RegistrationEmailService;

class SendRegistrationConfirmationEmail
{
    public function __construct(
        private readonly RegistrationEmailService $emailService,
    ) {}

    public function handle(RegistrationNotification $event): void
    {
        $this->emailService->send($event->registration, $event->paymentLink);
    }
}
