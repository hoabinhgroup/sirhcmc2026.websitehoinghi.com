<?php

namespace App\Filament\Exports;

use App\Models\AbstractSubmission;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class AbstractSubmissionExporter extends Exporter
{
    protected static ?string $model = AbstractSubmission::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('created_at')->label('Ngày nộp'),
            ExportColumn::make('submission_code')->label('Mã submission'),
            ExportColumn::make('presenter_scope')
                ->label('Phạm vi')
                ->state(fn (AbstractSubmission $record): string => match ($record->presenter_scope) {
                    'domestic' => 'Trong nước',
                    'international' => 'Quốc tế',
                    default => (string) $record->presenter_scope,
                }),
            ExportColumn::make('abstract_category')
                ->label('Chủ đề')
                ->state(fn (AbstractSubmission $record): string => $record->category_label),
            ExportColumn::make('title')->label('Danh xưng'),
            ExportColumn::make('fullname')->label('Họ tên'),
            ExportColumn::make('affiliation')->label('Đơn vị'),
            ExportColumn::make('position')->label('Chức vụ'),
            ExportColumn::make('date_of_birth')
                ->label('Ngày sinh')
                ->state(fn (AbstractSubmission $record): string => $record->date_of_birth_formatted),
            ExportColumn::make('citizen_id')->label('CCCD'),
            ExportColumn::make('country')->label('Quốc gia'),
            ExportColumn::make('phone')->label('Điện thoại'),
            ExportColumn::make('email'),
            ExportColumn::make('dietary')->label('Ăn kiêng'),
            ExportColumn::make('status')->label('Trạng thái'),
            ExportColumn::make('review_note')->label('Ghi chú review'),
            ExportColumn::make('abstract_file')
                ->label('Abstract')
                ->state(fn (AbstractSubmission $record): ?string => $record->fileUrl('abstract_file')),
            ExportColumn::make('cv_file')
                ->label('CV')
                ->state(fn (AbstractSubmission $record): ?string => $record->fileUrl('cv_file')),
            ExportColumn::make('headshot_file')
                ->label('Headshot')
                ->state(fn (AbstractSubmission $record): ?string => $record->fileUrl('headshot_file')),
            ExportColumn::make('degree_file')
                ->label('Degree')
                ->state(fn (AbstractSubmission $record): ?string => $record->fileUrl('degree_file')),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Xuất Excel hoàn tất: '.number_format($export->successful_rows).' dòng.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.number_format($failedRowsCount).' dòng lỗi.';
        }

        return $body;
    }
}
