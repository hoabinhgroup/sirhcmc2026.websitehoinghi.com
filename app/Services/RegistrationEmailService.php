<?php

namespace App\Services;

use App\Enums\PaymentMethod;
use App\Enums\RegistrationStatus;
use App\Mail\AbstractReceivedMail;
use App\Mail\AbstractResultMail;
use App\Mail\RegistrationConfirmationMail;
use App\Mail\RegistrationTemplateMail;
use App\Models\AbstractSubmission;
use App\Models\Registration;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Throwable;

class RegistrationEmailService
{
    public function __construct(
        private readonly EmailLogService $emailLogService,
    ) {}

    public function send(Registration $registration, ?string $paymentLink = null): void
    {
        $templateKey = $this->resolveRegistrationTemplate($registration);

        $this->sendTemplate($registration, $templateKey, $paymentLink);
    }

    public function sendPaymentSuccess(Registration $registration): void
    {
        $this->sendTemplate($registration, 'payment_success');
    }

    public function sendPaymentFailed(Registration $registration): void
    {
        $this->sendTemplate($registration, 'payment_failed');
    }

    public function resend(Registration $registration, ?string $templateKey = null, ?string $paymentLink = null): void
    {
        $templateKey = $templateKey ?? $this->resolveRegistrationTemplate($registration);

        $this->sendTemplate($registration, $templateKey, $paymentLink);
    }

    public function sendAbstractReceived(AbstractSubmission $submission): void
    {
        $this->deliver(
            $submission,
            'abstract_received',
            $submission->email,
            $this->abstractReceivedSubject($submission),
            new AbstractReceivedMail($submission),
        );
    }

    public function sendAbstractResult(AbstractSubmission $submission, string $result): void
    {
        $this->deliver(
            $submission,
            'abstract_result',
            $submission->email,
            $this->abstractResultSubject($submission, $result),
            new AbstractResultMail($submission, $result),
        );
    }

    private function sendTemplate(Registration $registration, string $templateKey, ?string $paymentLink = null): void
    {
        $subject = $this->registrationSubject($registration, $templateKey);

        $mailable = new RegistrationTemplateMail(
            $registration,
            $templateKey,
            $subject,
            $paymentLink,
        );

        $this->deliver($registration, $templateKey, $registration->email, $subject, $mailable);
    }

    private function deliver(
        Registration|AbstractSubmission $owner,
        string $templateKey,
        string $recipient,
        string $subject,
        RegistrationTemplateMail|AbstractReceivedMail|AbstractResultMail|RegistrationConfirmationMail $mailable,
    ): void {
        try {
            if (config('registration.email.use_api')) {
                $this->sendViaApi($recipient, $subject, $mailable->render());
            } else {
                Mail::to($recipient)->send($mailable);
            }

            $this->emailLogService->logSent($owner, $templateKey, $recipient, $subject);
        } catch (Throwable $exception) {
            $this->emailLogService->logFailed(
                $owner,
                $templateKey,
                $recipient,
                $subject,
                $exception->getMessage(),
            );

            throw $exception;
        }
    }

    private function sendViaApi(string $recipient, string $subject, string $html): void
    {
        Http::post(config('registration.email.endpoint'), [
            'sending_server' => config('registration.email.sending_server'),
            'email' => $recipient,
            'from_email' => config('registration.email.from_email'),
            'from_name' => config('registration.email.from_name'),
            'subject' => $subject,
            'reply_to' => config('registration.email.reply_to'),
            'addCC' => config('registration.email.cc'),
            'template' => $html,
        ]);
    }

    private function resolveRegistrationTemplate(Registration $registration): string
    {
        if ((float) $registration->total <= 0 || $registration->isFeeWaived()) {
            return 'fee_waived';
        }

        if ($registration->isBankTransfer()) {
            return 'bank_transfer';
        }

        if ($registration->isOnepay()) {
            return 'online_payment';
        }

        return 'fee_waived';
    }

    private function registrationSubject(Registration $registration, string $templateKey): string
    {
        $code = $registration->guest_code;

        if ($registration->is_international) {
            return match ($templateKey) {
                'payment_success' => "SIRHCM 2026 Payment Successful – {$code}",
                'payment_failed' => "SIRHCM 2026 Payment Failed – {$code}",
                'bank_transfer' => "SIRHCM 2026 Registration & Bank Transfer Instructions – {$code}",
                'online_payment' => "SIRHCM 2026 Registration & Online Payment – {$code}",
                default => "SIRHCM 2026 Registration Confirmation – {$code}",
            };
        }

        return match ($templateKey) {
            'payment_success' => "Thanh toán thành công SIRHCM 2026 – {$code}",
            'payment_failed' => "Thanh toán thất bại SIRHCM 2026 – {$code}",
            'bank_transfer' => "Xác nhận đăng ký & hướng dẫn chuyển khoản SIRHCM 2026 – {$code}",
            'online_payment' => "Xác nhận đăng ký & thanh toán online SIRHCM 2026 – {$code}",
            default => "Xác nhận đăng ký miễn phí SIRHCM 2026 – {$code}",
        };
    }

    private function abstractReceivedSubject(AbstractSubmission $submission): string
    {
        return $submission->isDomestic()
            ? "Xác nhận nộp abstract SIRHCM 2026 – {$submission->submission_code}"
            : "SIRHCM 2026 Abstract Submission Received – {$submission->submission_code}";
    }

    private function abstractResultSubject(AbstractSubmission $submission, string $result): string
    {
        $label = match ($result) {
            'accepted' => $submission->isDomestic() ? 'Chấp nhận' : 'Accepted',
            'rejected' => $submission->isDomestic() ? 'Không chấp nhận' : 'Not Accepted',
            default => $submission->isDomestic() ? 'Yêu cầu chỉnh sửa' : 'Revision Requested',
        };

        return $submission->isDomestic()
            ? "Kết quả abstract SIRHCM 2026 – {$label} – {$submission->submission_code}"
            : "SIRHCM 2026 Abstract Result – {$label} – {$submission->submission_code}";
    }
}
