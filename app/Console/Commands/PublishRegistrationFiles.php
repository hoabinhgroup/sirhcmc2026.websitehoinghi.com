<?php

namespace App\Console\Commands;

use App\Models\Registration;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class PublishRegistrationFiles extends Command
{
    protected $signature = 'registration:publish-files';

    protected $description = 'Copy registration upload files from private storage to public storage';

    public function handle(): int
    {
        $published = 0;

        Registration::query()
            ->whereNotNull('degree_file')
            ->orWhereNotNull('young_ir_proof')
            ->each(function (Registration $registration) use (&$published): void {
                foreach (['degree_file', 'young_ir_proof'] as $attribute) {
                    $path = $registration->{$attribute};

                    if (blank($path)) {
                        continue;
                    }

                    if (Storage::disk('public')->exists($path)) {
                        continue;
                    }

                    if (! Storage::disk('local')->exists($path)) {
                        $this->warn("Missing file for {$registration->guest_code}: {$path}");

                        continue;
                    }

                    Storage::disk('public')->put(
                        $path,
                        Storage::disk('local')->get($path)
                    );

                    $published++;
                    $this->line("Published {$registration->guest_code}: {$path}");
                }
            });

        $this->info("Published {$published} file(s).");

        return self::SUCCESS;
    }
}
