<?php

namespace App\Services;

use App\Models\Registration;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class RegistrationFileService
{
    public function storeDegreeFile(?UploadedFile $file, Registration $registration): void
    {
        if (! $file) {
            return;
        }

        $path = $this->storeFile($file, $registration, 'degree');
        $registration->update(['degree_file' => $path]);
    }

    public function storeYoungIrProof(?UploadedFile $file, Registration $registration): void
    {
        if (! $file) {
            return;
        }

        $path = $this->storeFile($file, $registration, 'young_ir');
        $registration->update(['young_ir_proof' => $path]);
    }

    private function storeFile(UploadedFile $file, Registration $registration, string $folder): string
    {
        $appName = config('app.name', 'sirhcm2026');
        $storagePath = "{$appName}/files/registration/{$folder}/{$registration->id}";
        $filename = $file->getClientOriginalName();

        return $file->storeAs($storagePath, $filename, 'public');
    }
}
