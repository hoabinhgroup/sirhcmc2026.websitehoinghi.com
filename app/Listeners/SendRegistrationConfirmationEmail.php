<?php

namespace App\Listeners;

use App\Events\RegistrationNotification;
use App\Services\RegistrationEmailService;
use Throwable;

class SendRegistrationConfirmationEmail
{
    public function __construct(
        private readonly RegistrationEmailService $emailService,
    ) {}

    public function handle(RegistrationNotification $event): void
    {
        try {
            $this->emailService->send($event->registration, $event->paymentLink);
        } catch (Throwable $exception) {
            report($exception);
        }
    }
}
