<?php

namespace App\Enums;

enum RegistrationStatus: string
{
    case Submitted = 'submitted';
    case PaymentRedirected = 'payment_redirected';
    case Pending = 'pending';
    case Successful = 'successful';
    case Failed = 'failed';
    case Cancelled = 'cancelled';
    case PaidManual = 'paid_manual';
    case Confirmed = 'confirmed';
    case ReceiptSent = 'receipt_sent';
    case CancelRequested = 'cancel_requested';
    case RefundPending = 'refund_pending';
    case Refunded = 'refunded';

    public function label(): string
    {
        return match ($this) {
            self::Submitted => 'Submitted',
            self::PaymentRedirected => 'Payment redirected',
            self::Pending => 'Pending',
            self::Successful => 'Payment successful',
            self::Failed => 'Payment failed',
            self::Cancelled => 'Cancelled',
            self::PaidManual => 'Paid (manual)',
            self::Confirmed => 'Confirmed',
            self::ReceiptSent => 'Receipt sent',
            self::CancelRequested => 'Cancel requested',
            self::RefundPending => 'Refund pending',
            self::Refunded => 'Refunded',
        };
    }

    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $case): array => [$case->value => $case->label()])
            ->all();
    }
}
