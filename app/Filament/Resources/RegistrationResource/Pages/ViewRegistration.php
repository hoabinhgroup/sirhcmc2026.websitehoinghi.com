<?php

namespace App\Filament\Resources\RegistrationResource\Pages;

use App\Enums\RegistrationStatus;
use App\Filament\Resources\RegistrationResource;
use App\Models\AdminNote;
use App\Services\PaymentRecordService;
use App\Services\RegistrationEmailService;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;

class ViewRegistration extends ViewRecord
{
    protected static string $resource = RegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('resend_email')
                ->label('Gửi lại email')
                ->icon('heroicon-o-envelope')
                ->action(function (RegistrationEmailService $emailService): void {
                    $emailService->resend($this->record);
                    Notification::make()->title('Đã gửi lại email')->success()->send();
                }),
            Actions\Action::make('mark_paid')
                ->label('Xác nhận chuyển khoản')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->visible(fn (): bool => in_array($this->record->status, [
                    RegistrationStatus::Pending->value,
                    'pending',
                ], true))
                ->form([
                    Forms\Components\TextInput::make('reference')
                        ->label('Mã tham chiếu CK')
                        ->maxLength(300),
                ])
                ->action(function (array $data, PaymentRecordService $paymentService, RegistrationEmailService $emailService): void {
                    $paymentService->markManualPaid($this->record, $data['reference'] ?? null);
                    $this->record->update([
                        'status' => RegistrationStatus::PaidManual->value,
                        'paid_at' => Carbon::now('Asia/Bangkok'),
                        'confirmed_at' => Carbon::now('Asia/Bangkok'),
                    ]);
                    $emailService->sendPaymentSuccess($this->record->fresh());
                    Notification::make()->title('Đã xác nhận thanh toán')->success()->send();
                }),
            Actions\Action::make('check_in')
                ->label('Check-in')
                ->icon('heroicon-o-ticket')
                ->color('info')
                ->visible(fn (): bool => ! $this->record->isCheckedIn())
                ->requiresConfirmation()
                ->action(function (): void {
                    $this->record->update([
                        'checkin' => 1,
                        'checked_in_at' => Carbon::now('Asia/Bangkok'),
                    ]);
                    Notification::make()->title('Đã check-in')->success()->send();
                }),
            Actions\Action::make('cancel_refund')
                ->label('Hủy / Hoàn tiền')
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->visible(fn (): bool => $this->record->canRequestRefund() && ! in_array($this->record->status, [
                    RegistrationStatus::Cancelled->value,
                    RegistrationStatus::Refunded->value,
                ], true))
                ->form([
                    Forms\Components\Select::make('action_type')
                        ->label('Loại xử lý')
                        ->options([
                            RegistrationStatus::CancelRequested->value => 'Yêu cầu hủy',
                            RegistrationStatus::RefundPending->value => 'Chờ hoàn tiền',
                            RegistrationStatus::Cancelled->value => 'Đã hủy',
                            RegistrationStatus::Refunded->value => 'Đã hoàn tiền',
                        ])
                        ->required(),
                    Forms\Components\Textarea::make('note')
                        ->label('Ghi chú')
                        ->required(),
                ])
                ->action(function (array $data): void {
                    $updates = ['status' => $data['action_type']];

                    if (in_array($data['action_type'], [
                        RegistrationStatus::Cancelled->value,
                        RegistrationStatus::Refunded->value,
                    ], true)) {
                        $updates['cancelled_at'] = Carbon::now('Asia/Bangkok');
                    }

                    $this->record->update($updates);

                    AdminNote::query()->create([
                        'owner_type' => $this->record::class,
                        'owner_id' => $this->record->id,
                        'admin_id' => auth()->id(),
                        'note' => $data['note'],
                    ]);

                    Notification::make()->title('Đã cập nhật trạng thái hủy/hoàn')->success()->send();
                }),
            Actions\EditAction::make(),
        ];
    }
}
