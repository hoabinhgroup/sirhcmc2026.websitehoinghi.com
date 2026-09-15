<?php

namespace App\Listeners;

use App\Events\PaymentFailedNotification;
use App\Services\RegistrationEmailService;
use Throwable;

class SendPaymentFailedEmail
{
    public function __construct(
        private readonly RegistrationEmailService $emailService,
    ) {}

    public function handle(PaymentFailedNotification $event): void
    {
        try {
            $this->emailService->sendPaymentFailed($event->registration);
        } catch (Throwable $exception) {
            report($exception);
        }
    }
}
