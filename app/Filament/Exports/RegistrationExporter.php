<?php

namespace App\Filament\Exports;

use App\Models\Registration;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class RegistrationExporter extends Exporter
{
    protected static ?string $model = Registration::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('created_at')->label('Ngày đăng ký'),
            ExportColumn::make('guest_code')->label('Mã đăng ký'),
            ExportColumn::make('title')->label('Danh xưng'),
            ExportColumn::make('fullname')->label('Họ tên'),
            ExportColumn::make('affiliation')->label('Đơn vị'),
            ExportColumn::make('position')->label('Chức vụ'),
            ExportColumn::make('country')->label('Quốc gia'),
            ExportColumn::make('phone')->label('Điện thoại'),
            ExportColumn::make('email'),
            ExportColumn::make('dietary')->label('Ăn kiêng'),
            ExportColumn::make('conference_type')
                ->label('Gói phí')
                ->state(fn (Registration $record): string => $record->conference_type),
            ExportColumn::make('galadinner')
                ->label('Gala dinner')
                ->state(fn (Registration $record): string => $record->galadinnerLabel()),
            ExportColumn::make('payment_method')->label('Thanh toán'),
            ExportColumn::make('status')->label('Trạng thái'),
            ExportColumn::make('total')->label('Tổng tiền'),
            ExportColumn::make('degree_file')
                ->label('Bằng cấp')
                ->state(fn (Registration $record): ?string => $record->degreeFileAbsoluteUrl()),
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
