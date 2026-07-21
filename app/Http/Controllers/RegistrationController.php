<?php

namespace App\Http\Controllers;

use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Enums\RegistrationStatus;
use App\Events\PaymentFailedNotification;
use App\Events\PaymentSuccessNotification;
use App\Events\RegistrationNotification;
use App\Http\Middleware\EnsureRegistrationOpen;
use App\Http\Requests\RegistrationSubmitRequest;
use App\Models\Registration;
use App\Services\FeeCalculationService;
use App\Services\OnepayService;
use App\Services\PaymentRecordService;
use App\Services\RegistrationFileService;
use App\Services\RegistrationPaymentService;
use Carbon\Carbon;
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
        private readonly FeeCalculationService $feeCalculator,
        private readonly PaymentRecordService $paymentRecordService,
    ) {}

    public static function middleware(): array
    {
        return [
            new Middleware(EnsureRegistrationOpen::class, only: ['form', 'formInternational', 'submit']),
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

    public function submit(RegistrationSubmitRequest $request): RedirectResponse|View
    {
        $isInternational = $request->isInternational();
        $delegateCategory = (string) $request->input('conference_checklist_item');
        $galaDinner = $request->boolean('galadinner_fee');
        $paymentMethod = $request->input('payment_method');

        $fees = $this->feeCalculator->calculate(
            $delegateCategory,
            $galaDinner,
            $paymentMethod,
        );

        $registration = DB::transaction(function () use ($request, $isInternational, $delegateCategory, $galaDinner, $fees, $paymentMethod) {
            $registration = Registration::create([
                'guest_code' => Registration::generateGuestCode(),
                'title' => $request->input('title') === 'other'
                    ? $request->input('titleOther')
                    : $request->input('title'),
                'fullname' => $request->input('fullname'),
                'position' => $request->input('position'),
                'affiliation' => $request->input('affiliation'),
                'category' => $isInternational ? 'INTERNATIONAL REGISTRATION' : 'LOCAL REGISTRATION',
                'is_international' => $isInternational,
                'locale' => $isInternational ? 'en' : 'vi',
                'galadinner' => $galaDinner,
                'country' => $isInternational ? $request->input('country') : 'VN',
                'day' => $request->input('day'),
                'month' => $request->input('month'),
                'year' => $request->input('year'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'dietary' => $request->input('dietary') === 'other'
                    ? $request->input('dietaryOther')
                    : $request->input('dietary'),
                'conference_fees' => json_encode([$delegateCategory]),
                'price_period' => $fees['price_period'],
                'base_fee' => $fees['base_fee'],
                'gala_fee_amount' => $fees['gala_fee'],
                'transaction_fee' => $fees['transaction_fee'],
                'total' => $fees['total'],
                'payment_method' => $fees['total'] > 0 && $paymentMethod
                    ? PaymentMethod::fromFormValue($paymentMethod)->value
                    : null,
                'status' => $fees['total'] === 0 ? 'confirmed' : PaymentStatus::Pending->value,
            ]);

            $this->fileService->storeDegreeFile($request->file('degree_file'), $registration);

            return $registration->fresh();
        });

        if ($fees['total'] === 0) {
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

            $updateData = [
                'orderinfo' => $request->input('vpc_OrderInfo'),
                'txnResponseCode' => $request->input('vpc_TxnResponseCode'),
                'vpc_TransactionNo' => $request->input('vpc_TransactionNo'),
                'status' => $status,
            ];

            if ($status === PaymentStatus::Successful->value) {
                $paidAt = Carbon::now('Asia/Bangkok');
                $recalculated = $this->feeCalculator->calculate(
                    (string) $registration->delegate_category,
                    (bool) $registration->galadinner,
                    'onepay',
                    $paidAt,
                );

                $updateData = array_merge($updateData, [
                    'paid_at' => $paidAt,
                    'confirmed_at' => $paidAt,
                    'price_period' => $recalculated['price_period'],
                    'base_fee' => $recalculated['base_fee'],
                    'gala_fee_amount' => $recalculated['gala_fee'],
                    'transaction_fee' => $recalculated['transaction_fee'],
                    'total' => $recalculated['total'],
                    'status' => RegistrationStatus::Confirmed->value,
                ]);
            }

            $registration->update($updateData);
            $registration->refresh();

            if ($status === PaymentStatus::Successful->value) {
                $this->paymentRecordService->markSuccessful($registration, $payload);
                event(new PaymentSuccessNotification($registration));
            } elseif ($status === PaymentStatus::Failed->value) {
                event(new PaymentFailedNotification($registration));
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

    private function renderForm(string $scope): View
    {
        $isInternational = $scope === 'international';
        $referenceDate = Carbon::now('Asia/Bangkok');
        $fees = collect(config('registration.fees', []))
            ->reject(fn (array $fee): bool => (bool) ($fee['hidden'] ?? false))
            ->map(function (array $fee, string $slug) use ($referenceDate): array {
                return array_merge($fee, [
                    'amount' => app(FeeCalculationService::class)->getDisplayFee($slug, $referenceDate),
                ]);
            })
            ->all();

        return view('pages.registration.delegate-registration', [
            'scope' => $scope,
            'isInternational' => $isInternational,
            'fees' => $fees,
            'titles' => config("registration.titles.{$scope}"),
            'dietaryOptions' => config("registration.dietary_options.{$scope}"),
            'galadinnerFee' => config('registration.galadinner_fee'),
            'bank' => config('registration.bank_transfer'),
            'pricePeriod' => app(FeeCalculationService::class)->resolvePricePeriod($referenceDate),
            'earlyDeadline' => config('registration.early_deadline'),
            'recaptchaSiteKey' => $isInternational ? null : config('services.recaptcha.site_key'),
        ]);
    }

    private function findByGuestCode(?string $guestCode): ?Registration
    {
        if (! $guestCode) {
            return null;
        }

        return Registration::query()->where('guest_code', $guestCode)->first();
    }
}
