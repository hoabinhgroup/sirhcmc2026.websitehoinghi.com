<?php

namespace App\Listeners;

use App\Events\PaymentFailedNotification;
use App\Services\RegistrationEmailService;

class SendPaymentFailedEmail
{
    public function __construct(
        private readonly RegistrationEmailService $emailService,
    ) {}

    public function handle(PaymentFailedNotification $event): void
    {
        $this->emailService->sendPaymentFailed($event->registration);
    }
}
