<?php

namespace App\Enums;

enum PaymentStatus: string
{
    case Successful = 'successful';
    case Cancelled = 'cancelled';
    case Failed = 'failed';
    case Pending = 'pending';

    public static function fromOnepayResponseCode(?string $code): self
    {
        return match ($code) {
            '0' => self::Successful,
            '99' => self::Cancelled,
            default => self::Failed,
        };
    }
}
