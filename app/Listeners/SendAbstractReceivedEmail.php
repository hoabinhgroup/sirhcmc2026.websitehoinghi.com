<?php

namespace App\Listeners;

use App\Events\AbstractSubmissionNotification;
use App\Services\RegistrationEmailService;
use Throwable;

class SendAbstractReceivedEmail
{
    public function __construct(
        private readonly RegistrationEmailService $emailService,
    ) {}

    public function handle(AbstractSubmissionNotification $event): void
    {
        try {
            $this->emailService->sendAbstractReceived($event->submission);
        } catch (Throwable $exception) {
            report($exception);
        }
    }
}
