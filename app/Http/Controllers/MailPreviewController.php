<?php

namespace App\Http\Controllers;

use App\Mail\AbstractReceivedMail;
use App\Mail\RegistrationTemplateMail;
use App\Models\AbstractSubmission;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MailPreviewController extends Controller
{
    public function __invoke(Request $request): View
    {
        abort_unless(app()->environment(['local', 'testing']), 404);

        $international = $request->query('locale') === 'en';
        $registrationTemplate = $this->registrationTemplate($request);

        $submission = $this->sampleSubmission($international);
        $registration = $this->sampleRegistration($international, $registrationTemplate);

        $abstractMail = new AbstractReceivedMail($submission);
        $registrationMail = new RegistrationTemplateMail(
            $registration,
            $registrationTemplate,
            $this->registrationSubject($registration, $registrationTemplate),
            $registrationTemplate === 'online_payment' ? 'https://example.test/onepay' : null,
        );

        $abstractEnvelope = $abstractMail->envelope();
        $ccList = collect($abstractEnvelope->cc)->map(fn ($address) => $address->address)->implode(', ');
        $bccList = collect($abstractEnvelope->bcc)->map(fn ($address) => $address->address)->implode(', ');

        return view('dev.mail-preview', [
            'locale' => $international ? 'en' : 'vi',
            'registrationTemplate' => $registrationTemplate,
            'ccList' => $ccList,
            'bccList' => $bccList,
            'abstractSubject' => $abstractEnvelope->subject,
            'abstractHtml' => $abstractMail->render(),
            'registrationSubject' => $registrationMail->envelope()->subject,
            'registrationHtml' => $registrationMail->render(),
        ]);
    }

    private function registrationTemplate(Request $request): string
    {
        $template = (string) $request->query('registration', 'bank_transfer');

        return in_array($template, ['bank_transfer', 'fee_waived', 'online_payment'], true)
            ? $template
            : 'bank_transfer';
    }

    private function sampleSubmission(bool $international): AbstractSubmission
    {
        return new AbstractSubmission([
            'submission_code' => $international ? 'SIRHCM26-A0002' : 'SIRHCM26-A0001',
            'locale' => $international ? 'en' : 'vi',
            'presenter_scope' => $international ? 'international' : 'domestic',
            'abstract_category' => 'thermal_ablation',
            'title' => $international ? 'Dr.' : 'TS.',
            'fullname' => $international ? 'Jane Doe' : 'Trần Thị B',
            'affiliation' => $international ? 'Tokyo Medical Center' : 'BV Đại học Y Dược TP.HCM',
            'email' => $international ? 'jane.doe@example.com' : 'tranthib@example.com',
            'status' => 'submitted',
        ]);
    }

    private function sampleRegistration(bool $international, string $template): Registration
    {
        $feeWaived = $template === 'fee_waived';

        return new Registration([
            'guest_code' => $international ? 'SIRHCM26-R0002' : 'SIRHCM26-R0001',
            'title' => $international ? 'Dr.' : 'BS.',
            'fullname' => $international ? 'John Smith' : 'Nguyễn Văn A',
            'affiliation' => $international ? 'Singapore General Hospital' : 'Bệnh viện Chợ Rẫy',
            'position' => $international ? 'Consultant' : 'Bác sĩ',
            'country' => $international ? 'Singapore' : 'VN',
            'phone' => '0901234567',
            'email' => $international ? 'john.smith@example.com' : 'nguyenvana@example.com',
            'galadinner' => ! $feeWaived,
            'is_international' => $international,
            'locale' => $international ? 'en' : 'vi',
            'conference_fees' => json_encode([$feeWaived ? 'plenary_invited' : 'physician']),
            'base_fee' => $feeWaived ? 0 : ($international ? 2_000_000 : 1_000_000),
            'gala_fee_amount' => $feeWaived ? 0 : 500_000,
            'transaction_fee' => $template === 'online_payment' ? ($international ? 150_000 : 90_000) : 0,
            'total' => $feeWaived ? 0 : ($template === 'online_payment'
                ? ($international ? 2_650_000 : 1_590_000)
                : ($international ? 2_500_000 : 1_500_000)),
            'payment_method' => match ($template) {
                'online_payment' => 'onepay-payment',
                'bank_transfer' => 'bank-transfer',
                default => null,
            },
            'status' => $feeWaived ? 'confirmed' : 'pending',
        ]);
    }

    private function registrationSubject(Registration $registration, string $template): string
    {
        $code = $registration->guest_code;

        if ($registration->is_international) {
            return match ($template) {
                'bank_transfer' => "SIRHCM 2026 Registration & Bank Transfer Instructions – {$code}",
                'online_payment' => "SIRHCM 2026 Registration & Online Payment – {$code}",
                default => "SIRHCM 2026 Registration Confirmation – {$code}",
            };
        }

        return match ($template) {
            'bank_transfer' => "Xác nhận đăng ký & hướng dẫn chuyển khoản SIRHCM 2026 – {$code}",
            'online_payment' => "Xác nhận đăng ký & thanh toán online SIRHCM 2026 – {$code}",
            default => "Xác nhận đăng ký miễn phí SIRHCM 2026 – {$code}",
        };
    }
}
