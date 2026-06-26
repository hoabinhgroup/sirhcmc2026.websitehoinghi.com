<?php

namespace App\Services;

use App\Filament\Exports\RegistrationExporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Database\Eloquent\Builder;
use OpenSpout\Common\Entity\Row;
use OpenSpout\Writer\XLSX\Writer;
use Symfony\Component\HttpFoundation\StreamedResponse;

class RegistrationExcelExportService
{
    private const HYPERLINK_COLUMNS = [
        'degree_file' => 'Xem bằng cấp',
    ];

    /**
     * @param  array<string, string>  $columnMap
     */
    public function download(Builder $query, array $columnMap): StreamedResponse
    {
        $query = RegistrationExporter::modifyQuery($query);
        $fileName = 'dang-ky-sirhcm2026-'.now()->format('Y-m-d-His').'.xlsx';
        $columnKeys = array_keys($columnMap);

        $export = new Export([
            'exporter' => RegistrationExporter::class,
        ]);

        $exporter = new RegistrationExporter($export, $columnMap, []);

        return response()->streamDownload(function () use ($query, $columnMap, $columnKeys, $fileName, $exporter): void {
            $writer = new Writer;
            $writer->openToBrowser($fileName);

            $writer->addRow(Row::fromValues(array_values($columnMap)));

            foreach ($query->lazy() as $record) {
                $values = $exporter($record);
                $values = $this->applyHyperlinks($values, $columnKeys);

                $writer->addRow(Row::fromValues($values));
            }

            $writer->close();
        }, $fileName, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }

    /**
     * @param  list<mixed>  $values
     * @param  list<string>  $columnKeys
     * @return list<mixed>
     */
    private function applyHyperlinks(array $values, array $columnKeys): array
    {
        foreach (self::HYPERLINK_COLUMNS as $column => $label) {
            $index = array_search($column, $columnKeys, true);

            if ($index === false) {
                continue;
            }

            $url = $values[$index] ?? null;

            if (! is_string($url) || $url === '') {
                continue;
            }

            $values[$index] = $this->hyperlinkFormula($url, $label);
        }

        return $values;
    }

    private function hyperlinkFormula(string $url, string $label): string
    {
        $escapedUrl = str_replace('"', '""', $url);
        $escapedLabel = str_replace('"', '""', $label);

        return '=HYPERLINK("'.$escapedUrl.'","'.$escapedLabel.'")';
    }
}
