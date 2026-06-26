<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRegistrationOpen
{
    public function handle(Request $request, Closure $next): Response
    {
        $deadline = Carbon::parse(config('registration.registration_deadline'));
        $now = Carbon::now();

        if ($now->greaterThan($deadline)) {
            return redirect()->route('registration.closed');
        }

        return $next($request);
    }
}
