<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AbstractSubmissionResource\Pages;
use App\Models\AbstractSubmission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AbstractSubmissionResource extends Resource
{
    protected static ?string $model = AbstractSubmission::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Abstract';

    protected static ?string $modelLabel = 'abstract';

    protected static ?string $pluralModelLabel = 'abstract';

    protected static ?string $navigationGroup = 'Hội nghị';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        $categoryOptions = config('abstract.categories', []);

        return $form
            ->schema([
                Forms\Components\Section::make('Thông tin abstract')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('submission_code')
                            ->label('Mã submission')
                            ->disabledOn('edit')
                            ->dehydrated(),
                        Forms\Components\Select::make('abstract_category')
                            ->label('Chủ đề')
                            ->options($categoryOptions)
                            ->required(),
                        Forms\Components\TextInput::make('title')->label('Danh xưng'),
                        Forms\Components\TextInput::make('fullname')->label('Họ tên')->required(),
                        Forms\Components\TextInput::make('affiliation')->label('Đơn vị'),
                        Forms\Components\TextInput::make('position')->label('Chức vụ'),
                        Forms\Components\TextInput::make('email')->email()->required(),
                        Forms\Components\TextInput::make('phone')->label('Điện thoại'),
                        Forms\Components\TextInput::make('citizen_id')->label('CCCD'),
                        Forms\Components\TextInput::make('country')->label('Quốc gia'),
                        Forms\Components\TextInput::make('dietary')->label('Ăn kiêng'),
                        Forms\Components\Select::make('presenter_scope')
                            ->label('Phạm vi')
                            ->options([
                                'domestic' => 'Trong nước',
                                'international' => 'Quốc tế',
                            ]),
                        Forms\Components\Select::make('status')
                            ->label('Trạng thái')
                            ->options([
                                'submitted' => 'Submitted',
                                'under_review' => 'Under review',
                                'accepted' => 'Accepted',
                                'rejected' => 'Rejected',
                                'revision_requested' => 'Revision requested',
                                'withdrawn' => 'Withdrawn',
                            ])
                            ->required(),
                        Forms\Components\Textarea::make('review_note')
                            ->label('Ghi chú review')
                            ->columnSpanFull(),
                    ]),
                Forms\Components\Section::make('Files')
                    ->schema([
                        Forms\Components\TextInput::make('abstract_file')->label('Abstract')->disabled(),
                        Forms\Components\TextInput::make('cv_file')->label('CV')->disabled(),
                        Forms\Components\TextInput::make('headshot_file')->label('Headshot')->disabled(),
                        Forms\Components\TextInput::make('degree_file')->label('Degree')->disabled(),
                    ])
                    ->collapsed(),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Thông tin')
                    ->columns(2)
                    ->schema([
                        Infolists\Components\TextEntry::make('submission_code')->label('Mã'),
                        Infolists\Components\TextEntry::make('category_label')->label('Chủ đề'),
                        Infolists\Components\TextEntry::make('fullname')->label('Họ tên'),
                        Infolists\Components\TextEntry::make('title')->label('Danh xưng'),
                        Infolists\Components\TextEntry::make('affiliation')->label('Đơn vị'),
                        Infolists\Components\TextEntry::make('email'),
                        Infolists\Components\TextEntry::make('phone')->label('Điện thoại'),
                        Infolists\Components\TextEntry::make('citizen_id')->label('CCCD'),
                        Infolists\Components\TextEntry::make('country')->label('Quốc gia'),
                        Infolists\Components\TextEntry::make('status')->label('Trạng thái'),
                        Infolists\Components\TextEntry::make('created_at')->label('Ngày nộp')->dateTime(),
                    ]),
                Infolists\Components\Section::make('Files')
                    ->schema([
                        Infolists\Components\TextEntry::make('abstract_file')->label('Abstract'),
                        Infolists\Components\TextEntry::make('cv_file')->label('CV'),
                        Infolists\Components\TextEntry::make('headshot_file')->label('Headshot'),
                        Infolists\Components\TextEntry::make('degree_file')->label('Degree'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        $categoryOptions = config('abstract.categories', []);

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('submission_code')->label('Mã')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('fullname')->label('Họ tên')->searchable(),
                Tables\Columns\TextColumn::make('abstract_category')
                    ->label('Chủ đề')
                    ->formatStateUsing(fn (string $state): string => $categoryOptions[$state] ?? $state)
                    ->limit(40),
                Tables\Columns\TextColumn::make('presenter_scope')->label('Phạm vi')->badge(),
                Tables\Columns\TextColumn::make('status')->label('Trạng thái')->badge(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('created_at')->label('Ngày nộp')->dateTime()->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('abstract_category')
                    ->label('Chủ đề')
                    ->options($categoryOptions),
                Tables\Filters\SelectFilter::make('presenter_scope')
                    ->label('Phạm vi')
                    ->options([
                        'domestic' => 'Trong nước',
                        'international' => 'Quốc tế',
                    ]),
                Tables\Filters\SelectFilter::make('status')
                    ->label('Trạng thái')
                    ->options([
                        'submitted' => 'Submitted',
                        'under_review' => 'Under review',
                        'accepted' => 'Accepted',
                        'rejected' => 'Rejected',
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
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAbstractSubmissions::route('/'),
            'create' => Pages\CreateAbstractSubmission::route('/create'),
            'view' => Pages\ViewAbstractSubmission::route('/{record}'),
            'edit' => Pages\EditAbstractSubmission::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
