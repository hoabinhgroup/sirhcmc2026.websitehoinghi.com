<?php

use App\Mail\AbstractReceivedMail;
use App\Mail\AbstractResultMail;
use App\Mail\RegistrationTemplateMail;
use App\Models\AbstractSubmission;
use App\Models\Registration;
use Illuminate\Support\Facades\Mail;

require __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$recipient = $argv[1] ?? 'minhphamquang028@gmail.com';

$makeRegistration = function (bool $international, array $overrides = []) use ($recipient): Registration {
    $base = [
        'guest_code' => $international ? 'SIRHCM26-R-TEST-EN' : 'SIRHCM26-R-TEST-VN',
        'title' => $international ? 'Dr.' : 'BS.',
        'fullname' => $international ? 'John Smith' : 'Nguyễn Văn A',
        'affiliation' => $international ? 'Singapore General Hospital' : 'Bệnh viện Chợ Rẫy',
        'position' => $international ? 'Consultant' : 'Bác sĩ',
        'country' => $international ? 'Singapore' : 'VN',
        'phone' => '0901234567',
        'email' => $recipient,
        'galadinner' => true,
        'is_international' => $international,
        'locale' => $international ? 'en' : 'vi',
        'conference_fees' => json_encode([$international ? 'physician' : 'physician']),
        'base_fee' => $international ? 2_000_000 : 1_000_000,
        'gala_fee_amount' => 800_000,
        'transaction_fee' => $international ? 168_000 : 108_000,
        'total' => $international ? 2_968_000 : 1_908_000,
        'payment_method' => 'onepay-payment',
        'vpc_TransactionNo' => 'TEST-TXN-123456',
        'status' => 'confirmed',
    ];

    return new Registration(array_merge($base, $overrides));
};

$makeSubmission = function (bool $domestic, array $overrides = []) use ($recipient): AbstractSubmission {
    $base = [
        'submission_code' => $domestic ? 'SIRHCM26-A-TEST-VN' : 'SIRHCM26-A-TEST-EN',
        'locale' => $domestic ? 'vi' : 'en',
        'presenter_scope' => $domestic ? 'domestic' : 'international',
        'abstract_category' => 'thermal_ablation',
        'title' => $domestic ? 'TS.' : 'Dr.',
        'fullname' => $domestic ? 'Trần Thị B' : 'Jane Doe',
        'affiliation' => $domestic ? 'BV Đại học Y Dược TP.HCM' : 'Tokyo Medical Center',
        'email' => $recipient,
        'status' => 'submitted',
        'review_note' => $domestic
            ? 'Vui lòng bổ sung số liệu follow-up trong phần kết quả.'
            : 'Please add follow-up data in the results section.',
    ];

    return new AbstractSubmission(array_merge($base, $overrides));
};

$registrationSubjects = [
    'fee_waived' => [
        false => '[TEST-VN] Xác nhận đăng ký miễn phí SIRHCM 2026 – SIRHCM26-R-TEST-VN',
        true => '[TEST-EN] SIRHCM 2026 Registration Confirmation – SIRHCM26-R-TEST-EN',
    ],
    'bank_transfer' => [
        false => '[TEST-VN] Xác nhận đăng ký & hướng dẫn chuyển khoản SIRHCM 2026 – SIRHCM26-R-TEST-VN',
        true => '[TEST-EN] SIRHCM 2026 Registration & Bank Transfer Instructions – SIRHCM26-R-TEST-EN',
    ],
    'online_payment' => [
        false => '[TEST-VN] Xác nhận đăng ký & thanh toán online SIRHCM 2026 – SIRHCM26-R-TEST-VN',
        true => '[TEST-EN] SIRHCM 2026 Registration & Online Payment – SIRHCM26-R-TEST-EN',
    ],
    'payment_success' => [
        false => '[TEST-VN] Thanh toán thành công SIRHCM 2026 – SIRHCM26-R-TEST-VN',
        true => '[TEST-EN] SIRHCM 2026 Payment Successful – SIRHCM26-R-TEST-EN',
    ],
    'payment_failed' => [
        false => '[TEST-VN] Thanh toán thất bại SIRHCM 2026 – SIRHCM26-R-TEST-VN',
        true => '[TEST-EN] SIRHCM 2026 Payment Failed – SIRHCM26-R-TEST-EN',
    ],
];

$sent = 0;
$errors = [];

foreach ([false, true] as $international) {
    $feeWaived = $makeRegistration($international, [
        'conference_fees' => json_encode(['sirhcm_member']),
        'base_fee' => 0,
        'gala_fee_amount' => 0,
        'transaction_fee' => 0,
        'total' => 0,
        'payment_method' => null,
        'galadinner' => false,
    ]);

    foreach ($registrationSubjects as $templateKey => $subjects) {
        $registration = $templateKey === 'fee_waived'
            ? $feeWaived
            : $makeRegistration($international);

        try {
            Mail::to($recipient)->send(new RegistrationTemplateMail(
                $registration,
                $templateKey,
                $subjects[$international],
                $templateKey === 'online_payment' ? 'https://mtf.onepay.vn/paygate/vpcpay.op?test=1' : null,
            ));
            $sent++;
            echo "OK: registration/{$templateKey} ".($international ? 'EN' : 'VN').PHP_EOL;
        } catch (Throwable $e) {
            $errors[] = "registration/{$templateKey} ".($international ? 'EN' : 'VN').': '.$e->getMessage();
            echo "FAIL: registration/{$templateKey} ".($international ? 'EN' : 'VN').' – '.$e->getMessage().PHP_EOL;
        }
    }
}

foreach ([false, true] as $domestic) {
    $submission = $makeSubmission($domestic);
    $label = $domestic ? 'VN' : 'EN';

    try {
        Mail::to($recipient)->send(new AbstractReceivedMail($submission));
        $sent++;
        echo "OK: abstract/received {$label}".PHP_EOL;
    } catch (Throwable $e) {
        $errors[] = "abstract/received {$label}: ".$e->getMessage();
        echo "FAIL: abstract/received {$label} – ".$e->getMessage().PHP_EOL;
    }

    foreach (['accepted', 'rejected', 'revision'] as $result) {
        try {
            Mail::to($recipient)->send(new AbstractResultMail($makeSubmission($domestic), $result));
            $sent++;
            echo "OK: abstract/result/{$result} {$label}".PHP_EOL;
        } catch (Throwable $e) {
            $errors[] = "abstract/result/{$result} {$label}: ".$e->getMessage();
            echo "FAIL: abstract/result/{$result} {$label} – ".$e->getMessage().PHP_EOL;
        }
    }
}

echo PHP_EOL."Done. Sent {$sent} email(s) to {$recipient}.".PHP_EOL;

if ($errors !== []) {
    echo count($errors).' error(s):'.PHP_EOL;
    foreach ($errors as $error) {
        echo '  - '.$error.PHP_EOL;
    }
    exit(1);
}
