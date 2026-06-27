<?php

namespace App\Filament\Resources\AbstractSubmissionResource\Pages;

use App\Filament\Resources\AbstractSubmissionResource;
use App\Services\RegistrationEmailService;
use Filament\Actions;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;

class ViewAbstractSubmission extends ViewRecord
{
    protected static string $resource = AbstractSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('send_result')
                ->label('Gửi email kết quả')
                ->icon('heroicon-o-envelope')
                ->form([
                    Forms\Components\Select::make('result')
                        ->label('Kết quả')
                        ->options([
                            'accepted' => 'Accepted / Chấp nhận',
                            'rejected' => 'Rejected / Từ chối',
                            'revision_requested' => 'Revision requested / Yêu cầu sửa',
                        ])
                        ->required(),
                    Forms\Components\Textarea::make('review_note')
                        ->label('Ghi chú review'),
                ])
                ->action(function (array $data, RegistrationEmailService $emailService): void {
                    $this->record->update([
                        'status' => $data['result'],
                        'review_note' => $data['review_note'] ?? $this->record->review_note,
                    ]);

                    $emailService->sendAbstractResult($this->record->fresh(), $data['result']);

                    Notification::make()->title('Đã gửi email kết quả')->success()->send();
                }),
            Actions\EditAction::make(),
        ];
    }
}
