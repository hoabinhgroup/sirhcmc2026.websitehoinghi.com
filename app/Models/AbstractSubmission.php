<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class AbstractSubmission extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'submission_code',
        'locale',
        'presenter_scope',
        'abstract_category',
        'title',
        'fullname',
        'affiliation',
        'position',
        'day',
        'month',
        'year',
        'citizen_id',
        'country',
        'phone',
        'email',
        'dietary',
        'abstract_file',
        'cv_file',
        'headshot_file',
        'degree_file',
        'status',
        'review_note',
    ];

    public function getCategoryLabelAttribute(): string
    {
        return config("abstract.categories.{$this->abstract_category}", $this->abstract_category);
    }

    public function getDateOfBirthFormattedAttribute(): string
    {
        if (! $this->day || ! $this->month || ! $this->year) {
            return '';
        }

        return sprintf('%02d/%02d/%04d', $this->day, $this->month, $this->year);
    }

    public function isDomestic(): bool
    {
        return $this->presenter_scope === 'domestic';
    }

    public function fileUrl(string $field): ?string
    {
        $path = $this->{$field};

        if (! $path) {
            return null;
        }

        if (Storage::disk('public')->exists($path)) {
            return url(Storage::disk('public')->url($path));
        }

        return null;
    }

    public static function generateSubmissionCode(): string
    {
        $prefix = config('abstract.submission_code_prefix', 'SIRHCM26-A');
        $sequence = static::withTrashed()->count() + 1;

        return sprintf('%s%04d', $prefix, $sequence);
    }
}
