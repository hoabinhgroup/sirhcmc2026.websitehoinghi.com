<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class RegistrationFileController extends Controller
{
    public function degree(Registration $registration): StreamedResponse|Response
    {
        return $this->streamFile($registration, 'degree_file');
    }

    private function streamFile(Registration $registration, string $attribute): StreamedResponse|Response
    {
        $path = $registration->{$attribute};

        abort_if(blank($path), 404);

        foreach (['public', 'local'] as $disk) {
            $storage = Storage::disk($disk);

            if ($storage->exists($path)) {
                return $storage->response($path);
            }
        }

        abort(404);
    }
}
