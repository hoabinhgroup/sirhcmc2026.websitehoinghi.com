<?php

namespace App\Filament\Pages;

use App\Models\EventSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class EventSettings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationLabel = 'Cấu hình';

    protected static ?string $title = 'Cấu hình sự kiện';

    protected static ?string $navigationGroup = 'Hội nghị';

    protected static ?int $navigationSort = 10;

    protected static string $view = 'filament.pages.event-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'registration_deadline' => EventSetting::get('registration_deadline', config('registration.registration_deadline')),
            'abstract_deadline' => EventSetting::get('abstract_deadline', config('abstract.submission_deadline')),
            'early_deadline' => EventSetting::get('early_deadline', config('registration.early_deadline')),
            'refund_deadline' => EventSetting::get('refund_deadline', config('registration.refund_deadline')),
            'registration_open' => EventSetting::get('registration_open', true),
            'abstract_open' => EventSetting::get('abstract_open', true),
            'galadinner_fee' => EventSetting::get('galadinner_fee', config('registration.galadinner_fee')),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Deadline')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('registration_deadline')
                            ->label('Hạn đăng ký')
                            ->required(),
                        Forms\Components\TextInput::make('abstract_deadline')
                            ->label('Hạn nộp abstract')
                            ->required(),
                        Forms\Components\TextInput::make('early_deadline')
                            ->label('Early bird đến')
                            ->required(),
                        Forms\Components\TextInput::make('refund_deadline')
                            ->label('Hạn hủy/hoàn tiền')
                            ->required(),
                    ]),
                Forms\Components\Section::make('Form & phí')
                    ->columns(2)
                    ->schema([
                        Forms\Components\Toggle::make('registration_open')
                            ->label('Mở form đăng ký'),
                        Forms\Components\Toggle::make('abstract_open')
                            ->label('Mở form abstract'),
                        Forms\Components\TextInput::make('galadinner_fee')
                            ->label('Phí Gala Dinner (VND)')
                            ->numeric()
                            ->required(),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ($data as $key => $value) {
            EventSetting::set($key, $value);
        }

        Notification::make()
            ->title('Đã lưu cấu hình')
            ->success()
            ->send();
    }
}
