<?php

namespace App\Models;

use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Registration extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'guest_code',
        'title',
        'fullname',
        'position',
        'affiliation',
        'category',
        'galadinner',
        'country',
        'day',
        'month',
        'year',
        'passport',
        'phone',
        'email',
        'dietary',
        'conference_fees',
        'total',
        'price_period',
        'base_fee',
        'gala_fee_amount',
        'transaction_fee',
        'attach',
        'oral_attach',
        'degree_file',
        'young_ir_proof',
        'payment_method',
        'is_international',
        'locale',
        'orderinfo',
        'vpc_TransactionNo',
        'status',
        'txnResponseCode',
        'paid_at',
        'confirmed_at',
        'cancelled_at',
        'checkin',
        'checked_in_at',
    ];

    protected function casts(): array
    {
        return [
            'galadinner' => 'boolean',
            'is_international' => 'boolean',
            'total' => 'decimal:2',
            'base_fee' => 'decimal:2',
            'gala_fee_amount' => 'decimal:2',
            'transaction_fee' => 'decimal:2',
            'paid_at' => 'datetime',
            'confirmed_at' => 'datetime',
            'cancelled_at' => 'datetime',
            'checked_in_at' => 'datetime',
        ];
    }

    public function payments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function emailLogs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(EmailLog::class, 'owner_id')
            ->where('owner_type', self::class);
    }

    public function adminNotes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(AdminNote::class, 'owner_id')
            ->where('owner_type', self::class);
    }

    public function isCheckedIn(): bool
    {
        return (bool) $this->checkin || $this->checked_in_at !== null;
    }

    public function canRequestRefund(): bool
    {
        return Carbon::now('Asia/Bangkok')
            ->lte(Carbon::parse(config('registration.refund_deadline'), 'Asia/Bangkok'));
    }

    public function getCountryNameAttribute(): string
    {
        return $this->country === 'VN' ? 'Việt Nam' : (string) $this->country;
    }

    public function getConferenceFeesListAttribute(): array
    {
        $fees = json_decode((string) $this->conference_fees, true);

        return is_array($fees) ? $fees : [];
    }

    public function getDelegateCategoryAttribute(): ?string
    {
        return $this->conference_fees_list[0] ?? null;
    }

    public function getConferenceTypeAttribute(): string
    {
        $slug = $this->delegate_category;
        $config = config('registration.fees', []);

        if ($slug && isset($config[$slug])) {
            return $this->is_international
                ? ($config[$slug]['label_en'] ?? $slug)
                : ($config[$slug]['label_vi'] ?? $slug);
        }

        return collect($this->conference_fees_list)
            ->map(fn (string $feeSlug) => $config[$feeSlug]['label_vi'] ?? $feeSlug)
            ->implode(', ');
    }

    public function getTotalFormattedAttribute(): string
    {
        return 'VND '.number_format((float) $this->total, 0, '.', ',');
    }

    public function getSubtotalFormattedAttribute(): string
    {
        $subtotal = (float) $this->base_fee + (float) $this->gala_fee_amount;

        return 'VND '.number_format($subtotal, 0, '.', ',');
    }

    public function getTotalTaxFormattedAttribute(): string
    {
        if ((float) $this->transaction_fee > 0) {
            return 'VND '.number_format((float) $this->total, 0, '.', ',');
        }

        $taxRate = (float) config('payment.onepay_tax_rate', 0.06);
        $subtotal = (float) $this->base_fee + (float) $this->gala_fee_amount;
        $totalWithTax = $subtotal * (1 + $taxRate);

        return 'VND '.number_format($totalWithTax, 0, '.', ',');
    }

    public function getEmailSubjectAttribute(): string
    {
        if ($this->is_international) {
            return "SIRHCM 2026 Registration Confirmation – {$this->title} {$this->fullname}";
        }

        return "Xác nhận đăng ký SIRHCM 2026 – {$this->title} {$this->fullname}";
    }

    public function getRegistrationChannelAttribute(): string
    {
        if (! $this->payment_method) {
            return 'fee-waived';
        }

        return (string) $this->payment_method;
    }

    public function isFeeWaived(): bool
    {
        $slug = $this->delegate_category;

        return $slug && (bool) data_get(config("registration.fees.{$slug}"), 'fee_waiver', false);
    }

    public function paymentStatusLabel(): string
    {
        return match ($this->status) {
            PaymentStatus::Successful->value => 'Successful',
            PaymentStatus::Cancelled->value => 'Cancelled',
            PaymentStatus::Failed->value => 'Failed',
            'confirmed' => 'Confirmed',
            default => 'Pending',
        };
    }

    public function isOnepay(): bool
    {
        return $this->payment_method === PaymentMethod::Onepay->value;
    }

    public function isBankTransfer(): bool
    {
        return $this->payment_method === PaymentMethod::BankTransfer->value;
    }

    public function degreeFileUrl(): ?string
    {
        return $this->degreeFileAbsoluteUrl();
    }

    public function degreeFileAbsoluteUrl(): ?string
    {
        if (! $this->degree_file) {
            return null;
        }

        if (Storage::disk('public')->exists($this->degree_file)) {
            return url(Storage::disk('public')->url($this->degree_file));
        }

        return route('registration.files.degree', $this);
    }

    public function galadinnerLabel(): string
    {
        return $this->galadinner ? 'Có / Yes' : 'Không / No';
    }

    public static function generateGuestCode(): string
    {
        $prefix = config('registration.guest_code_prefix', 'SIRHCM26-R');
        $sequence = static::withTrashed()->count() + 1;

        return sprintf('%s%04d', $prefix, $sequence);
    }
}
