<?php

namespace App\Services;

use App\Enums\PaymentMethod;
use App\Enums\RegistrationStatus;
use App\Models\Payment;
use App\Models\Registration;
use Carbon\Carbon;

class PaymentRecordService
{
    public function createPending(Registration $registration, string $provider = 'onepay'): Payment
    {
        return Payment::query()->create([
            'registration_id' => $registration->id,
            'provider' => $provider,
            'payment_method' => $registration->payment_method,
            'amount' => $registration->total,
            'transaction_fee' => $registration->transaction_fee,
            'currency' => 'VND',
            'status' => RegistrationStatus::Pending->value,
        ]);
    }

    public function markSuccessful(Registration $registration, array $callbackPayload = []): Payment
    {
        $payment = Payment::query()
            ->where('registration_id', $registration->id)
            ->whereIn('status', [RegistrationStatus::Pending->value, RegistrationStatus::Failed->value])
            ->latest()
            ->first();

        if (! $payment) {
            $payment = $this->createPending($registration);
        }

        $payment->update([
            'status' => RegistrationStatus::Successful->value,
            'gateway_transaction_id' => $callbackPayload['vpc_TransactionNo'] ?? null,
            'paid_at' => Carbon::now('Asia/Bangkok'),
            'raw_callback_json' => $callbackPayload ?: null,
        ]);

        return $payment->fresh();
    }

    public function markManualPaid(Registration $registration, ?string $reference = null): Payment
    {
        return Payment::query()->create([
            'registration_id' => $registration->id,
            'provider' => 'manual',
            'payment_method' => PaymentMethod::BankTransfer->value,
            'amount' => $registration->total,
            'transaction_fee' => 0,
            'currency' => 'VND',
            'bank_transfer_reference' => $reference,
            'status' => RegistrationStatus::PaidManual->value,
            'paid_at' => Carbon::now('Asia/Bangkok'),
        ]);
    }
}
