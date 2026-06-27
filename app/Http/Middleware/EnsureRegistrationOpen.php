<?php

namespace App\Http\Middleware;

use App\Models\EventSetting;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRegistrationOpen
{
    public function handle(Request $request, Closure $next): Response
    {
        if (EventSetting::get('registration_open', true) === false) {
            return redirect()->route('registration.closed');
        }

        $deadline = EventSetting::get('registration_deadline', config('registration.registration_deadline'));
        $now = Carbon::now('Asia/Bangkok');

        if ($now->greaterThan(Carbon::parse($deadline, 'Asia/Bangkok'))) {
            return redirect()->route('registration.closed');
        }

        return $next($request);
    }
}
