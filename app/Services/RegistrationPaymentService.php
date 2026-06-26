<?php

namespace App\Services;

use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Events\RegistrationNotification;
use App\Models\Registration;

class RegistrationPaymentService
{
    public function __construct(
        private readonly OnepayService $onepayService,
    ) {}

    public function process(Registration $registration): Registration
    {
        if ($registration->payment_method === PaymentMethod::Onepay->value) {
            $redirectUrl = $this->onepayService->buildPaymentLink(
                $registration,
                route('payment.registration.dr')
            );

            $registration->update(['status' => PaymentStatus::Pending->value]);
            $registration->setAttribute(PaymentMethod::REDIRECT_ATTRIBUTE, $redirectUrl);

            event(new RegistrationNotification($registration, $redirectUrl));

            return $registration;
        }

        if ($registration->payment_method === PaymentMethod::BankTransfer->value) {
            $registration->update(['status' => PaymentStatus::Pending->value]);
            $registration->setAttribute(PaymentMethod::BANK_TRANSFER_VIEW_DATA, $registration);

            event(new RegistrationNotification($registration));

            return $registration;
        }

        return $registration;
    }
}
