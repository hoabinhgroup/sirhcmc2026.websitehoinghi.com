<?php

return [

    'submission_deadline' => env('ABSTRACT_SUBMISSION_DEADLINE', '2026-09-01 23:59:59'),

    'acceptance_announcement' => env('ABSTRACT_ACCEPTANCE_DATE', '2026-09-15'),

    'submission_code_prefix' => env('ABSTRACT_CODE_PREFIX', 'SIRHCM26-A'),

    'event' => [
        'name_vi' => 'Hội nghị khoa học Điện Quang Can Thiệp Hồ Chí Minh lần thứ 2 (SIRHCM2026)',
        'name_en' => 'The Society of Interventional Radiology Annual Scientific Meeting 2nd (SIRHCM2026)',
        'email' => 'sirhcm2024@gmail.com',
    ],

    'categories' => [
        'management_ir' => 'NON-VASCULAR INTERVENTION',
        'chemoembolization_tace' => 'HCC',
        'embolotherapy' => 'EMBOLIZATION',
        'urinary_tract' => 'PELVIC INTERVENTION',
        'neuro_carotid' => 'STROKE',
        'peripheral_vascular' => 'AVF/ PAD',
        'thermal_ablation' => 'ABLATION',
        'non_thermal_ablation' => 'DAVF/ AVM',
        'tips_portal_vein' => 'PORTAL HYPERTENSION - CONSENSUS',
        'experimental_ir' => 'M&M',
        'evar_tevar' => 'ANEURYSM/ FDS',
        'artificial_intelligence' => 'INNOVATION',
        'pain_management' => 'PAIN MANAGEMENT',
        'radiation_safety' => 'TECHNICIAN-NURSE',
        'trauma_embolization' => 'CONCENSUS FOR IR MANAGEMANT OF PORTAL HYPERTENSION',
        'vascular_malformations' => 'VASCULAR MALFORMATION',
        'bone_spine_soft_tissue' => 'MSK',
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
        'max_kb' => (int) env('ABSTRACT_UPLOAD_MAX_KB', 10240),
        'mimes' => ['pdf', 'jpg', 'jpeg', 'png', 'doc', 'docx'],
        'image_mimes' => ['jpg', 'jpeg', 'png'],
    ],

];
