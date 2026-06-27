<?php

namespace App\Http\Controllers;

use App\Events\AbstractSubmissionNotification;
use App\Http\Middleware\EnsureAbstractSubmissionOpen;
use App\Http\Requests\AbstractSubmissionSubmitRequest;
use App\Models\AbstractSubmission;
use App\Services\AbstractSubmissionFileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AbstractSubmissionController extends Controller implements HasMiddleware
{
    public function __construct(
        private readonly AbstractSubmissionFileService $fileService,
    ) {}

    public static function middleware(): array
    {
        return [
            new Middleware(EnsureAbstractSubmissionOpen::class, only: ['form', 'formInternational', 'submit']),
        ];
    }

    public function form(): View
    {
        return $this->renderForm('domestic');
    }

    public function formInternational(): View
    {
        return $this->renderForm('international');
    }

    public function submit(AbstractSubmissionSubmitRequest $request): View
    {
        $isInternational = $request->isInternational();

        $submission = DB::transaction(function () use ($request, $isInternational) {
            $submission = AbstractSubmission::create([
                'submission_code' => AbstractSubmission::generateSubmissionCode(),
                'locale' => $isInternational ? 'en' : 'vi',
                'presenter_scope' => $isInternational ? 'international' : 'domestic',
                'abstract_category' => $request->input('abstract_category'),
                'title' => $request->input('title') === 'other'
                    ? $request->input('titleOther')
                    : $request->input('title'),
                'fullname' => $request->input('fullname'),
                'affiliation' => $request->input('affiliation'),
                'position' => $request->input('position'),
                'day' => $request->input('day'),
                'month' => $request->input('month'),
                'year' => $request->input('year'),
                'citizen_id' => $isInternational ? null : $request->input('citizen_id'),
                'country' => $isInternational ? $request->input('country') : 'VN',
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'dietary' => $request->input('dietary') === 'other'
                    ? $request->input('dietaryOther')
                    : $request->input('dietary'),
                'status' => 'submitted',
            ]);

            $this->fileService->storeFiles([
                'abstract_file' => $request->file('abstract_file'),
                'cv_file' => $request->file('cv_file'),
                'headshot_file' => $request->file('headshot_file'),
                'degree_file' => $request->file('degree_file'),
            ], $submission);

            return $submission->fresh();
        });

        event(new AbstractSubmissionNotification($submission));

        return view('pages.registration.partials.abstract-success', [
            'submission' => $submission,
        ]);
    }

    public function closed(): View
    {
        return view('pages.registration.abstract-closed');
    }

    private function renderForm(string $scope): View
    {
        $isInternational = $scope === 'international';

        return view('pages.registration.abstract-submission-form', [
            'scope' => $scope,
            'isInternational' => $isInternational,
            'categories' => config('abstract.categories', []),
            'titles' => config("abstract.titles.{$scope}"),
            'dietaryOptions' => config("abstract.dietary_options.{$scope}"),
            'submissionDeadline' => config('abstract.submission_deadline'),
            'recaptchaSiteKey' => $isInternational ? null : config('services.recaptcha.site_key'),
        ]);
    }
}
