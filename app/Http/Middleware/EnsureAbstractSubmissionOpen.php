<?php

namespace App\Http\Middleware;

use App\Models\EventSetting;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAbstractSubmissionOpen
{
    public function handle(Request $request, Closure $next): Response
    {
        if (EventSetting::get('abstract_open', true) === false) {
            return redirect()->route('registration.abstract-submission.closed');
        }

        $deadline = EventSetting::get('abstract_deadline', config('abstract.submission_deadline'));

        if (Carbon::now('Asia/Bangkok')->greaterThan(Carbon::parse($deadline, 'Asia/Bangkok'))) {
            return redirect()->route('registration.abstract-submission.closed');
        }

        return $next($request);
    }
}
