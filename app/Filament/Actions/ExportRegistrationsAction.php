<?php

namespace App\Filament\Actions;

use App\Filament\Exports\RegistrationExporter;
use App\Services\RegistrationExcelExportService;
use Filament\Actions\Exports\ExportColumn;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Tables\Actions\Action;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ExportRegistrationsAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'export';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Xuất Excel');
        $this->icon('heroicon-o-arrow-down-tray');
        $this->color('gray');
        $this->modalHeading('Xuất danh sách đăng ký');
        $this->modalSubmitActionLabel('Tải xuống');
        $this->modalWidth('xl');

        $this->form([
            Fieldset::make('Cột xuất Excel')
                ->columns(1)
                ->inlineLabel()
                ->statePath('columnMap')
                ->schema(
                    collect(RegistrationExporter::getColumns())
                        ->map(fn (ExportColumn $column): Split => Split::make([
                            Checkbox::make('isEnabled')
                                ->label($column->getLabel())
                                ->hiddenLabel()
                                ->default($column->isEnabledByDefault())
                                ->live()
                                ->grow(false),
                            TextInput::make('label')
                                ->label('Tên cột')
                                ->hiddenLabel()
                                ->default($column->getLabel())
                                ->placeholder($column->getLabel())
                                ->disabled(fn (Get $get): bool => ! $get('isEnabled'))
                                ->required(fn (Get $get): bool => (bool) $get('isEnabled')),
                        ])
                            ->verticallyAlignCenter()
                            ->statePath($column->getName()))
                        ->all()
                ),
        ]);

        $this->action(function (array $data, HasTable $livewire) {
            $columnMap = $this->resolveColumnMap($data['columnMap'] ?? []);

            return app(RegistrationExcelExportService::class)->download(
                $livewire->getTableQueryForExport(),
                $columnMap,
            );
        });
    }

    /**
     * @param  array<string, array<string, mixed>>  $columnMapState
     * @return array<string, string>
     */
    private function resolveColumnMap(array $columnMapState): array
    {
        return collect($columnMapState)
            ->dot()
            ->reduce(
                fn (Collection $carry, mixed $value, string $key): Collection => $carry->mergeRecursive([
                    Str::beforeLast($key, '.') => [Str::afterLast($key, '.') => $value],
                ]),
                collect()
            )
            ->filter(fn (array $column): bool => $column['isEnabled'] ?? false)
            ->mapWithKeys(fn (array $column, string $columnName): array => [$columnName => $column['label']])
            ->all();
    }
}
