<?php

namespace App\Services;

use App\Models\AbstractSubmission;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class AbstractSubmissionFileService
{
    /**
     * @param  array<string, UploadedFile|null>  $files
     */
    public function storeFiles(array $files, AbstractSubmission $submission): void
    {
        $updates = [];

        foreach ($files as $field => $file) {
            if (! $file instanceof UploadedFile) {
                continue;
            }

            $folder = match ($field) {
                'abstract_file' => 'abstract',
                'cv_file' => 'cv',
                'headshot_file' => 'headshot',
                'degree_file' => 'degree',
                default => 'misc',
            };

            $updates[$field] = $this->storeFile($file, $submission, $folder);
        }

        if ($updates !== []) {
            $submission->update($updates);
        }
    }

    private function storeFile(UploadedFile $file, AbstractSubmission $submission, string $folder): string
    {
        $prefix = config('abstract.submission_code_prefix', 'SIRHCM26-A');
        $storagePath = "{$prefix}/files/abstract/{$folder}/{$submission->id}";
        $filename = $file->getClientOriginalName();

        Storage::disk('public')->makeDirectory($storagePath);

        return $file->storeAs($storagePath, $filename, 'public');
    }
}
