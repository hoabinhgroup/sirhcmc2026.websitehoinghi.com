<?php

namespace App\Events;

use App\Models\Registration;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RegistrationNotification
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public Registration $registration,
        public ?string $paymentLink = null,
    ) {}
}
