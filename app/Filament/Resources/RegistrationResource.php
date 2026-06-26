<?php

namespace App\Filament\Resources;

use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Filament\Resources\RegistrationResource\Pages;
use App\Filament\Actions\ExportRegistrationsAction;
use App\Models\Registration;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RegistrationResource extends Resource
{
    protected static ?string $model = Registration::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Đăng ký';

    protected static ?string $modelLabel = 'đăng ký';

    protected static ?string $pluralModelLabel = 'đăng ký';

    protected static ?string $navigationGroup = 'Hội nghị';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        $feeOptions = collect(config('registration.fees', []))
            ->mapWithKeys(fn (array $fee, string $slug): array => [$slug => $fee['label_vi']])
            ->all();

        return $form
            ->schema([
                Forms\Components\Section::make('Thông tin chung')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('guest_code')
                            ->label('Mã đăng ký')
                            ->maxLength(150)
                            ->disabledOn('edit')
                            ->dehydrated(),
                        Forms\Components\TextInput::make('title')
                            ->label('Danh xưng')
                            ->maxLength(300),
                        Forms\Components\TextInput::make('fullname')
                            ->label('Họ tên')
                            ->required()
                            ->maxLength(250),
                        Forms\Components\TextInput::make('affiliation')
                            ->label('Đơn vị công tác')
                            ->maxLength(300),
                        Forms\Components\TextInput::make('position')
                            ->label('Chức vụ')
                            ->maxLength(250),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(150),
                        Forms\Components\TextInput::make('phone')
                            ->label('Điện thoại')
                            ->tel()
                            ->maxLength(50),
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('day')
                                    ->label('Ngày sinh')
                                    ->numeric()
                                    ->minValue(1)
                                    ->maxValue(31),
                                Forms\Components\TextInput::make('month')
                                    ->label('Tháng')
                                    ->numeric()
                                    ->minValue(1)
                                    ->maxValue(12),
                                Forms\Components\TextInput::make('year')
                                    ->label('Năm')
                                    ->numeric()
                                    ->minValue(1940)
                                    ->maxValue((int) date('Y')),
                            ]),
                        Forms\Components\TextInput::make('dietary')
                            ->label('Ăn kiêng')
                            ->maxLength(300),
                        Forms\Components\TextInput::make('country')
                            ->label('Quốc gia')
                            ->default('VN')
                            ->maxLength(120),
                        Forms\Components\TextInput::make('category')
                            ->label('Loại đăng ký')
                            ->default('LOCAL REGISTRATION')
                            ->maxLength(100),
                        Forms\Components\Toggle::make('galadinner')
                            ->label('Gala Dinner'),
                        Forms\Components\Toggle::make('is_international')
                            ->label('Quốc tế'),
                    ]),
                Forms\Components\Section::make('Phí & thanh toán')
                    ->columns(2)
                    ->schema([
                        Forms\Components\Select::make('conference_fees')
                            ->label('Gói phí')
                            ->options($feeOptions)
                            ->formatStateUsing(fn (?string $state): ?string => self::feeSlugFromState($state))
                            ->dehydrateStateUsing(fn (?string $state): ?string => $state ? json_encode([$state]) : null),
                        Forms\Components\TextInput::make('total')
                            ->label('Tổng tiền (VND)')
                            ->required()
                            ->numeric()
                            ->default(0),
                        Forms\Components\Select::make('payment_method')
                            ->label('Phương thức thanh toán')
                            ->options([
                                PaymentMethod::Onepay->value => 'OnePay',
                                PaymentMethod::BankTransfer->value => 'Chuyển khoản',
                            ]),
                        Forms\Components\Select::make('status')
                            ->label('Trạng thái thanh toán')
                            ->options([
                                PaymentStatus::Pending->value => 'Pending',
                                PaymentStatus::Successful->value => 'Successful',
                                PaymentStatus::Cancelled->value => 'Cancelled',
                                PaymentStatus::Failed->value => 'Failed',
                            ]),
                        Forms\Components\TextInput::make('orderinfo')
                            ->label('Order info'),
                        Forms\Components\TextInput::make('vpc_TransactionNo')
                            ->label('Mã giao dịch'),
                        Forms\Components\TextInput::make('txnResponseCode')
                            ->label('Txn response code'),
                        Forms\Components\TextInput::make('checkin')
                            ->label('Check-in')
                            ->numeric()
                            ->default(0),
                    ]),
                Forms\Components\Section::make('Tệp đính kèm')
                    ->schema([
                        Forms\Components\TextInput::make('degree_file')
                            ->label('Bằng cấp (path)')
                            ->disabled(),
                        Forms\Components\TextInput::make('young_ir_proof')
                            ->label('Young IR proof (path)')
                            ->disabled(),
                    ])
                    ->collapsed(),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Thông tin đăng ký')
                    ->columns(2)
                    ->schema([
                        Infolists\Components\TextEntry::make('guest_code')->label('Mã đăng ký'),
                        Infolists\Components\TextEntry::make('fullname')->label('Họ tên'),
                        Infolists\Components\TextEntry::make('title')->label('Danh xưng'),
                        Infolists\Components\TextEntry::make('affiliation')->label('Đơn vị'),
                        Infolists\Components\TextEntry::make('position')->label('Chức vụ'),
                        Infolists\Components\TextEntry::make('email'),
                        Infolists\Components\TextEntry::make('phone')->label('Điện thoại'),
                        Infolists\Components\TextEntry::make('dietary')->label('Ăn kiêng'),
                        Infolists\Components\TextEntry::make('conference_type')->label('Gói phí'),
                        Infolists\Components\IconEntry::make('galadinner')->label('Gala Dinner')->boolean(),
                        Infolists\Components\TextEntry::make('total_formatted')->label('Tổng tiền'),
                    ]),
                Infolists\Components\Section::make('Thanh toán')
                    ->columns(2)
                    ->schema([
                        Infolists\Components\TextEntry::make('payment_method')->label('Phương thức'),
                        Infolists\Components\TextEntry::make('status')
                            ->label('Trạng thái')
                            ->badge()
                            ->color(fn (?string $state): string => match ($state) {
                                PaymentStatus::Successful->value => 'success',
                                PaymentStatus::Cancelled->value => 'warning',
                                PaymentStatus::Failed->value => 'danger',
                                default => 'gray',
                            }),
                        Infolists\Components\TextEntry::make('vpc_TransactionNo')->label('Mã giao dịch'),
                        Infolists\Components\TextEntry::make('created_at')->label('Ngày đăng ký')->dateTime(),
                    ]),
                Infolists\Components\Section::make('Tệp đính kèm')
                    ->schema([
                        Infolists\Components\TextEntry::make('degree_file')
                            ->label('Bằng cấp')
                            ->url(fn (Registration $record): ?string => $record->degreeFileUrl())
                            ->openUrlInNewTab()
                            ->placeholder('—'),
                        Infolists\Components\TextEntry::make('young_ir_proof')
                            ->label('Young IR proof')
                            ->placeholder('—'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('guest_code')
                    ->label('Mã ĐK')
                    ->searchable()
                    ->sortable()
                    ->copyable(),
                Tables\Columns\TextColumn::make('fullname')
                    ->label('Họ tên')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('affiliation')
                    ->label('Đơn vị')
                    ->searchable()
                    ->limit(30)
                    ->toggleable(),
                Tables\Columns\TextColumn::make('conference_type')
                    ->label('Gói phí')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Thanh toán')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        PaymentMethod::Onepay->value => 'OnePay',
                        PaymentMethod::BankTransfer->value => 'Bank transfer',
                        default => $state ?? '—',
                    })
                    ->color(fn (?string $state): string => match ($state) {
                        PaymentMethod::Onepay->value => 'info',
                        PaymentMethod::BankTransfer->value => 'warning',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('status')
                    ->label('Trạng thái')
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        PaymentStatus::Successful->value => 'success',
                        PaymentStatus::Cancelled->value => 'warning',
                        PaymentStatus::Failed->value => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('total')
                    ->label('Tổng')
                    ->numeric(decimalPlaces: 0)
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày ĐK')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('payment_method')
                    ->label('Thanh toán')
                    ->options([
                        PaymentMethod::Onepay->value => 'OnePay',
                        PaymentMethod::BankTransfer->value => 'Chuyển khoản',
                    ]),
                Tables\Filters\SelectFilter::make('status')
                    ->label('Trạng thái')
                    ->options([
                        PaymentStatus::Pending->value => 'Pending',
                        PaymentStatus::Successful->value => 'Successful',
                        PaymentStatus::Cancelled->value => 'Cancelled',
                        PaymentStatus::Failed->value => 'Failed',
                    ]),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->headerActions([
                ExportRegistrationsAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRegistrations::route('/'),
            'create' => Pages\CreateRegistration::route('/create'),
            'view' => Pages\ViewRegistration::route('/{record}'),
            'edit' => Pages\EditRegistration::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    private static function feeSlugFromState(?string $state): ?string
    {
        if (! $state) {
            return null;
        }

        $decoded = json_decode($state, true);

        if (is_array($decoded) && isset($decoded[0])) {
            return (string) $decoded[0];
        }

        return $state;
    }
}
