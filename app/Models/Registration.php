<?php

namespace App\Models;

use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
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
        'attach',
        'oral_attach',
        'degree_file',
        'young_ir_proof',
        'payment_method',
        'is_international',
        'orderinfo',
        'vpc_TransactionNo',
        'status',
        'txnResponseCode',
        'checkin',
    ];

    protected function casts(): array
    {
        return [
            'galadinner' => 'boolean',
            'is_international' => 'boolean',
            'total' => 'decimal:2',
        ];
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

    public function getConferenceTypeAttribute(): string
    {
        $fees = $this->conference_fees_list;
        $config = config('registration.fees', []);

        return collect($fees)
            ->map(fn (string $slug) => $config[$slug]['label_vi'] ?? $slug)
            ->implode(', ');
    }

    public function getTotalFormattedAttribute(): string
    {
        return 'VND'.number_format((float) $this->total, 0, '.', ',');
    }

    public function getTotalTaxFormattedAttribute(): string
    {
        $taxRate = (float) config('payment.onepay_tax_rate', 0.06);
        $totalWithTax = (float) $this->total * (1 + $taxRate);

        return 'VND'.number_format($totalWithTax, 0, '.', ',');
    }

    public function getEmailSubjectAttribute(): string
    {
        if ($this->is_international) {
            return "SIRHCM 2026 Payment Confirmation – {$this->title} {$this->fullname}";
        }

        return "Xác nhận thanh toán SIRHCM 2026 – {$this->title} {$this->fullname}";
    }

    public function getRegistrationChannelAttribute(): string
    {
        if (! $this->payment_method) {
            return 'plenary-invited-speakers';
        }

        return (string) $this->payment_method;
    }

    public function paymentStatusLabel(): string
    {
        return match ($this->status) {
            PaymentStatus::Successful->value => 'Successful',
            PaymentStatus::Cancelled->value => 'Cancelled',
            PaymentStatus::Failed->value => 'Failed',
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
        return $this->galadinner ? 'Có' : 'Không';
    }

    public static function generateGuestCode(): string
    {
        $prefix = config('registration.guest_code_prefix', 'SIRHCM2026');
        $sequence = static::withTrashed()->count() + 1;

        return sprintf('%s-%03d', $prefix, $sequence);
    }
}
