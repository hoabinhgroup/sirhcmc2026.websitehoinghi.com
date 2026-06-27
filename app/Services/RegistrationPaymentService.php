<?php

namespace App\Services;

use App\Enums\PaymentMethod;
use App\Enums\RegistrationStatus;
use App\Events\RegistrationNotification;
use App\Models\Registration;

class RegistrationPaymentService
{
    public function __construct(
        private readonly OnepayService $onepayService,
        private readonly PaymentRecordService $paymentRecordService,
    ) {}

    public function process(Registration $registration): Registration
    {
        if ($registration->payment_method === PaymentMethod::Onepay->value) {
            $redirectUrl = $this->onepayService->buildPaymentLink(
                $registration,
                route('payment.registration.dr')
            );

            $this->paymentRecordService->createPending($registration);

            $registration->update(['status' => RegistrationStatus::PaymentRedirected->value]);
            $registration->setAttribute(PaymentMethod::REDIRECT_ATTRIBUTE, $redirectUrl);

            event(new RegistrationNotification($registration, $redirectUrl));

            return $registration;
        }

        if ($registration->payment_method === PaymentMethod::BankTransfer->value) {
            $this->paymentRecordService->createPending($registration, 'bank');

            $registration->update(['status' => RegistrationStatus::Pending->value]);
            $registration->setAttribute(PaymentMethod::BANK_TRANSFER_VIEW_DATA, $registration);

            event(new RegistrationNotification($registration));

            return $registration;
        }

        return $registration;
    }
}
