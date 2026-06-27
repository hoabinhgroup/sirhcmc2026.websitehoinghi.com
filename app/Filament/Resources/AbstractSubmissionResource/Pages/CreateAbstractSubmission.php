<?php

namespace App\Filament\Resources\AbstractSubmissionResource\Pages;

use App\Filament\Resources\AbstractSubmissionResource;
use App\Models\AbstractSubmission;
use Filament\Resources\Pages\CreateRecord;

class CreateAbstractSubmission extends CreateRecord
{
    protected static string $resource = AbstractSubmissionResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['submission_code'] = AbstractSubmission::generateSubmissionCode();

        return $data;
    }
}
