<?php

namespace App\Listeners;

use App\Events\AbstractSubmissionNotification;
use App\Services\RegistrationEmailService;

class SendAbstractReceivedEmail
{
    public function __construct(
        private readonly RegistrationEmailService $emailService,
    ) {}

    public function handle(AbstractSubmissionNotification $event): void
    {
        $this->emailService->sendAbstractReceived($event->submission);
    }
}
