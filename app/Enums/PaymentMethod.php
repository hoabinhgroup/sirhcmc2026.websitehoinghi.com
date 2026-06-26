<?php

namespace App\Enums;

enum PaymentMethod: string
{
    case Onepay = 'onepay-payment';
    case BankTransfer = 'bank-transfer';

    public const REDIRECT_ATTRIBUTE = 'onepay-payment-redirect';

    public const BANK_TRANSFER_VIEW_DATA = 'bank-transfer-feedback';

    public static function fromFormValue(string $value): self
    {
        return $value === 'onepay' ? self::Onepay : self::BankTransfer;
    }
}
