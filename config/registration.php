<?php

return [

    'registration_deadline' => env('REGISTRATION_DEADLINE', '2026-10-17 23:59:59'),

    'early_deadline' => env('REGISTRATION_EARLY_DEADLINE', '2026-09-15'),

    'standard_start' => env('REGISTRATION_STANDARD_START', '2026-09-16'),

    'refund_deadline' => env('REGISTRATION_REFUND_DEADLINE', '2026-10-05 23:59:59'),

    'guest_code_prefix' => env('REGISTRATION_CODE_PREFIX', 'SIRHCM26-R'),

    'galadinner_fee' => (int) env('REGISTRATION_GALADINNER_FEE', 800_000),

    'online_transaction_fee_percent' => (int) env('REGISTRATION_ONLINE_FEE_PERCENT', 6),

    'event' => [
        'name_vi' => 'Hội nghị khoa học Điện Quang Can Thiệp Hồ Chí Minh lần thứ 2 (SIRHCM2026)',
        'name_en' => 'The Society of Interventional Radiology Annual Scientific Meeting 2nd (SIRHCM2026)',
        'dates' => '16 - 17/10/2026',
        'venue' => 'Pullman Vung Tau, Viet Nam',
        'email' => 'sirhcm2024@gmail.com',
        'phone' => '+84 772 649 011',
    ],

    'fees' => [
        'physician' => [
            'label_vi' => 'Bác sĩ không phải thành viên SIRHCM',
            'label_en' => 'Physician (Non-SIRHCM Member)',
            'early' => 1_000_000,
            'standard' => 2_000_000,
            'fee_waiver' => false,
        ],
        'allied_health' => [
            'label_vi' => 'Nhân viên hỗ trợ y tế',
            'label_en' => 'Allied Health Professional',
            'early' => 800_000,
            'standard' => 1_200_000,
            'fee_waiver' => false,
        ],
        'sirhcm_member' => [
            'label_vi' => 'Hội viên SIRHCM',
            'label_en' => 'SIRHCM Member',
            'early' => 0,
            'standard' => 0,
            'fee_waiver' => true,
        ],
        'oral_presentation' => [
            'label_vi' => 'Báo cáo viên Oral',
            'label_en' => 'Oral Presentation',
            'early' => 0,
            'standard' => 0,
            'fee_waiver' => true,
        ],
        'poster_presentation' => [
            'label_vi' => 'Báo cáo viên Poster',
            'label_en' => 'Poster Presentation',
            'early' => 0,
            'standard' => 0,
            'fee_waiver' => true,
        ],
        'plenary_invited' => [
            'label_vi' => 'Plenary / Invited Speakers',
            'label_en' => 'Plenary / Invited Speakers',
            'early' => 0,
            'standard' => 0,
            'fee_waiver' => true,
        ],
    ],

    'email' => [
        'endpoint' => env('REGISTRATION_EMAIL_ENDPOINT', 'https://hoabinhclub.com/api/email/service'),
        'sending_server' => (int) env('REGISTRATION_EMAIL_SENDING_SERVER', 13),
        'from_email' => env('REGISTRATION_FROM_EMAIL', 'sirhcm2024@gmail.com'),
        'from_name' => env('REGISTRATION_FROM_NAME', 'SIRHCM 2026'),
        'reply_to' => env('REGISTRATION_REPLY_TO', 'sirhcm2024@gmail.com'),
        'cc' => [
            ['sirhcm2024@gmail.com', 'SIRHCM 2026'],
        ],
        'use_api' => env('REGISTRATION_EMAIL_USE_API', false),
    ],

    'bank_transfer' => [
        'account_name' => env('REGISTRATION_BANK_ACCOUNT_NAME', 'Công ty TNHH đầu tư thương mại và du lịch Quốc tế Hòa Bình'),
        'account_short_name' => env('REGISTRATION_BANK_ACCOUNT_SHORT_NAME'),
        'account_number' => env('REGISTRATION_BANK_ACCOUNT_NUMBER', '1112 0846 228 011'),
        'bank_name' => env('REGISTRATION_BANK_NAME', 'Ngân hàng TMCP Kỹ thương Việt Nam, CN Thăng Long, Hà Nội'),
        'bank_address' => env('REGISTRATION_BANK_ADDRESS'),
        'bank_code' => env('REGISTRATION_BANK_CODE', '01310001'),
        'swift' => env('REGISTRATION_BANK_SWIFT', 'VTCBVNVX'),
        'qr_image' => env('REGISTRATION_BANK_QR_IMAGE', 'img/registration-qr.png'),
        'content_template' => '{fullname} – {guest_code} | Đóng phí SIRHCM2026',
    ],

    'titles' => [
        'domestic' => [
            'GS.TS.' => 'GS.TS.',
            'PGS.TS.' => 'PGS.TS.',
            'TS.' => 'TS.',
            'BSCKI.' => 'BSCKI.',
            'BSCKII.' => 'BSCKII.',
            'BS.' => 'BS.',
            'KTV' => 'KTV',
            'Điều dưỡng' => 'Điều dưỡng',
            'other' => 'Khác',
        ],
        'international' => [
            'Prof.' => 'Prof.',
            'Dr.' => 'Dr.',
            'MSc.' => 'MSc.',
            'BSc.' => 'BSc.',
            'Mr.' => 'Mr.',
            'Ms.' => 'Ms.',
            'Technician' => 'Technician',
            'Nurse' => 'Nurse',
            'other' => 'Other',
        ],
    ],

    'dietary_options' => [
        'domestic' => [
            'Không có' => 'Không có',
            'Ăn chay' => 'Ăn chay',
            'other' => 'Khác',
        ],
        'international' => [
            'None' => 'None',
            'Halal' => 'Halal',
            'Vegetarian' => 'Vegetarian',
            'other' => 'Other',
        ],
    ],

    'upload' => [
        'max_kb' => (int) env('REGISTRATION_UPLOAD_MAX_KB', 10240),
        'mimes' => ['pdf', 'jpg', 'jpeg', 'png', 'doc', 'docx'],
    ],

];
