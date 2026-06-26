<?php

namespace App\Http\Controllers;

use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Events\RegistrationNotification;
use App\Http\Middleware\EnsureRegistrationOpen;
use App\Http\Requests\RegistrationSubmitRequest;
use App\Models\Registration;
use App\Services\OnepayService;
use App\Services\RegistrationFileService;
use App\Services\RegistrationPaymentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class RegistrationController extends Controller implements HasMiddleware
{
    public function __construct(
        private readonly RegistrationFileService $fileService,
        private readonly RegistrationPaymentService $paymentService,
        private readonly OnepayService $onepayService,
    ) {}

    public static function middleware(): array
    {
        return [
            new Middleware(EnsureRegistrationOpen::class, only: ['form', 'submit']),
        ];
    }

    public function form(): View
    {
        return view('pages.registration.delegate-registration', [
            'fees' => config('registration.fees'),
            'titles' => config('registration.titles'),
            'dietaryOptions' => config('registration.dietary_options'),
            'galadinnerFee' => config('registration.galadinner_fee'),
            'bank' => config('registration.bank_transfer'),
            'recaptchaSiteKey' => config('services.recaptcha.site_key'),
        ]);
    }

    public function submit(RegistrationSubmitRequest $request): RedirectResponse|View
    {
        $registration = DB::transaction(function () use ($request) {
            $feeSlug = (string) $request->input('conference_checklist_item');
            $feeAmount = (int) data_get(config("registration.fees.{$feeSlug}"), 'amount', 0);
            $galadinner = $request->boolean('galadinner_fee') ? 1 : 0;
            $galadinnerAmount = $galadinner ? (int) config('registration.galadinner_fee', 0) : 0;

            $registration = Registration::create([
                'guest_code' => Registration::generateGuestCode(),
                'title' => $request->input('title') === 'other'
                    ? $request->input('titleOther')
                    : $request->input('title'),
                'fullname' => $request->input('fullname'),
                'position' => $request->input('position'),
                'affiliation' => $request->input('affiliation'),
                'category' => $request->input('category'),
                'is_international' => $request->input('category') !== 'LOCAL REGISTRATION',
                'galadinner' => $galadinner,
                'country' => $request->input('country', 'VN'),
                'day' => $request->input('day'),
                'month' => $request->input('month'),
                'year' => $request->input('year'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'dietary' => $request->input('dietary') === 'other'
                    ? $request->input('dietaryOther')
                    : $request->input('dietary'),
                'conference_fees' => json_encode([$feeSlug]),
                'total' => $feeAmount + $galadinnerAmount,
                'payment_method' => PaymentMethod::fromFormValue($request->input('payment_method'))->value,
            ]);

            $this->fileService->storeDegreeFile($request->file('degree_file'), $registration);
            $this->fileService->storeYoungIrProof($request->file('young_ir_proof_early'), $registration);

            return $registration->fresh();
        });

        if ($request->input('category') === 'FACULTY / INVITED GUEST') {
            event(new RegistrationNotification($registration));

            return view('pages.registration.partials.plenary-success', [
                'registration' => $registration,
            ]);
        }

        $registration = $this->paymentService->process($registration);

        if ($redirect = $registration->getAttribute(PaymentMethod::REDIRECT_ATTRIBUTE)) {
            return redirect()->away($redirect);
        }

        return view('pages.registration.partials.payment-success', [
            'registration' => $registration,
            'bank' => config('registration.bank_transfer'),
        ]);
    }

    public function paymentCallback(Request $request): RedirectResponse
    {
        $payload = $request->all();
        $result = $this->onepayService->handleResponse($payload);

        $registration = Registration::query()
            ->where('guest_code', $request->input('vpc_OrderInfo'))
            ->first();

        if ($registration) {
            $status = $result['status'];

            if ($result['hash_valid'] && ! $this->onepayService->verifyAmount($registration, $payload)) {
                $status = PaymentStatus::Failed->value;
            }

            $registration->update([
                'orderinfo' => $request->input('vpc_OrderInfo'),
                'txnResponseCode' => $request->input('vpc_TxnResponseCode'),
                'vpc_TransactionNo' => $request->input('vpc_TransactionNo'),
                'status' => $status,
            ]);

            if ($status === PaymentStatus::Successful->value) {
                event(new RegistrationNotification($registration));
            }
        }

        return redirect()->route($result['route'], [
            'registration' => $registration?->guest_code,
        ]);
    }

    public function paymentSuccess(?string $registration = null): View
    {
        $model = $this->findByGuestCode($registration);

        return view('pages.registration.partials.onepay-success', [
            'registration' => $model,
        ]);
    }

    public function paymentCancel(?string $registration = null): View
    {
        return view('pages.registration.partials.onepay-cancel', [
            'registration' => $this->findByGuestCode($registration),
        ]);
    }

    public function paymentError(?string $registration = null): View
    {
        return view('pages.registration.partials.onepay-error', [
            'registration' => $this->findByGuestCode($registration),
        ]);
    }

    public function closed(): View
    {
        return view('pages.registration.closed');
    }

    private function findByGuestCode(?string $guestCode): ?Registration
    {
        if (! $guestCode) {
            return null;
        }

        return Registration::query()->where('guest_code', $guestCode)->first();
    }
}
