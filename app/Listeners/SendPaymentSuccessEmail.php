<?php

namespace App\Listeners;

use App\Events\PaymentSuccessNotification;
use App\Services\RegistrationEmailService;

class SendPaymentSuccessEmail
{
    public function __construct(
        private readonly RegistrationEmailService $emailService,
    ) {}

    public function handle(PaymentSuccessNotification $event): void
    {
        $this->emailService->sendPaymentSuccess($event->registration);
    }
}
