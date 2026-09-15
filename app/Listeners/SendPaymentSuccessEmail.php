<?php

namespace App\Listeners;

use App\Events\PaymentSuccessNotification;
use App\Services\RegistrationEmailService;
use Throwable;

class SendPaymentSuccessEmail
{
    public function __construct(
        private readonly RegistrationEmailService $emailService,
    ) {}

    public function handle(PaymentSuccessNotification $event): void
    {
        try {
            $this->emailService->sendPaymentSuccess($event->registration);
        } catch (Throwable $exception) {
            report($exception);
        }
    }
}
