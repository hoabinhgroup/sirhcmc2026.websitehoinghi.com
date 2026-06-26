<?php

return [

    'registration_deadline' => env('REGISTRATION_DEADLINE', '2026-12-31 23:59:00'),

    'guest_code_prefix' => env('REGISTRATION_CODE_PREFIX', 'SIRHCM2026'),

    'galadinner_fee' => (int) env('REGISTRATION_GALADINNER_FEE', 500000),

    'fees' => [
        'sirhcm_member' => [
            'label_vi' => 'Hội viên SIRHCM',
            'label_en' => 'SIRHCM Member',
            'amount' => 2_500_000,
            'requires_proof' => false,
        ],
        'non_sirhcm_member' => [
            'label_vi' => 'Không phải hội viên SIRHCM',
            'label_en' => 'Non-SIRHCM Member',
            'amount' => 3_000_000,
            'requires_proof' => false,
        ],
        'medical_staff' => [
            'label_vi' => 'Nhân viên y tế',
            'label_en' => 'Medical Staff',
            'amount' => 1_500_000,
            'requires_proof' => false,
        ],
        'young_ir' => [
            'label_vi' => 'Bác sĩ trẻ / Young IR (dưới 35 tuổi)',
            'label_en' => 'Young IR (under 35)',
            'amount' => 1_000_000,
            'requires_proof' => true,
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
        'bank_name' => env('REGISTRATION_BANK_NAME', 'MB Bank'),
        'account_name' => env('REGISTRATION_BANK_ACCOUNT_NAME', 'CÔNG TY TNHH ĐẦU TƯ THƯƠNG MẠI VÀ DU LỊCH QUỐC TẾ HÒA BÌNH'),
        'account_number' => env('REGISTRATION_BANK_ACCOUNT_NUMBER', ''),
        'branch' => env('REGISTRATION_BANK_BRANCH', 'MB Bank – 34 Láng Hạ, Quận Đống Đa, Hà Nội'),
        'bank_code' => env('REGISTRATION_BANK_CODE', '01311006'),
        'swift' => env('REGISTRATION_BANK_SWIFT', 'MSCBVNVX'),
        'qr_image' => env('REGISTRATION_BANK_QR_IMAGE', 'img/registration-qr.png'),
        'content_template' => '{fullname} – {guest_code} | Đóng phí SIRHCM2026',
    ],

    'titles' => [
        'GS.TS.' => 'GS.TS.',
        'PGS.TS.' => 'PGS.TS.',
        'TS.' => 'TS.',
        'BSCKI.' => 'BSCKI.',
        'BSCKII.' => 'BSCKII.',
        'BS.' => 'BS.',
        'other' => 'Khác / Other',
    ],

    'dietary_options' => [
        'Không có' => 'Không có / None',
        'Ăn chay' => 'Ăn chay / Vegetarian',
        'other' => 'Khác / Other',
    ],

];
