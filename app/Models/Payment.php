<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'registration_id',
        'provider',
        'payment_method',
        'amount',
        'transaction_fee',
        'currency',
        'gateway_transaction_id',
        'bank_transfer_reference',
        'status',
        'paid_at',
        'raw_callback_json',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'transaction_fee' => 'decimal:2',
            'paid_at' => 'datetime',
            'raw_callback_json' => 'array',
        ];
    }

    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class);
    }
}
