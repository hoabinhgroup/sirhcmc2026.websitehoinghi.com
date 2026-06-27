<?php

namespace App\Filament\Widgets;

use App\Enums\PaymentStatus;
use App\Enums\RegistrationStatus;
use App\Models\AbstractSubmission;
use App\Models\Registration;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ConferenceStatsWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalRegistrations = Registration::query()->count();
        $paidCount = Registration::query()
            ->whereIn('status', [
                PaymentStatus::Successful->value,
                RegistrationStatus::Confirmed->value,
                RegistrationStatus::PaidManual->value,
            ])
            ->count();
        $pendingCount = Registration::query()
            ->whereIn('status', [
                PaymentStatus::Pending->value,
                RegistrationStatus::PaymentRedirected->value,
            ])
            ->count();
        $freeCount = Registration::query()->where('total', '<=', 0)->count();
        $galaCount = Registration::query()->where('galadinner', true)->count();
        $revenue = (float) Registration::query()
            ->whereIn('status', [
                PaymentStatus::Successful->value,
                RegistrationStatus::Confirmed->value,
                RegistrationStatus::PaidManual->value,
            ])
            ->sum('total');
        $abstractCount = AbstractSubmission::query()->count();
        $abstractAccepted = AbstractSubmission::query()->where('status', 'accepted')->count();

        return [
            Stat::make('Đăng ký', (string) $totalRegistrations)
                ->description("Paid: {$paidCount} · Pending: {$pendingCount} · Free: {$freeCount}")
                ->color('primary'),
            Stat::make('Doanh thu (VND)', number_format($revenue, 0, '.', ','))
                ->description('Đã thanh toán / xác nhận')
                ->color('success'),
            Stat::make('Gala Dinner', (string) $galaCount)
                ->description('Số đăng ký chọn Gala')
                ->color('warning'),
            Stat::make('Abstract', (string) $abstractCount)
                ->description("Accepted: {$abstractAccepted}")
                ->color('info'),
        ];
    }
}
