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
        'artificial_intelligence' => 'Artificial intelligence (AI)',
        'biliary_intervention' => 'Biliary intervention',
        'biopsy_and_drainage' => 'Biopsy and drainage',
        'bone_spine_soft_tissue' => 'Bone, spine and soft tissue intervention',
        'chemoembolization_tace' => 'Chemoembolization (TACE)',
        'dialysis_venous_access' => 'Dialysis intervention and venous access',
        'embolotherapy' => 'Embolotherapy (excluding oncology)',
        'evar_tevar' => 'EVAR and TEVAR',
        'experimental_ir' => 'Experimental work in IR',
        'gi_tract' => 'GI tract intervention',
        'ivc_filters' => 'IVC filters',
        'management_ir' => 'Management in IR (including clinical practice)',
        'neuro_carotid' => 'Neuro and/or carotid intervention',
        'non_thermal_ablation' => 'Non-thermal ablation (including IRE)',
        'pain_management' => 'Pain management',
        'peripheral_vascular' => 'Peripheral vascular disease intervention',
        'radiation_safety' => 'Radiation safety and sustainability',
        'radioembolization_tare' => 'Radioembolization (TARE)',
        'renal_visceral_artery' => 'Renal and visceral artery intervention',
        'thermal_ablation' => 'Thermal ablation',
        'tips_portal_vein' => 'TIPS and portal vein intervention',
        'trauma_embolization' => 'Trauma embolization',
        'urinary_tract' => 'Urinary tract intervention',
        'vascular_malformations' => 'Vascular malformations and lymphatic intervention',
        'venous_intervention' => 'Venous intervention',
        'others' => 'Others',
    ],

    'titles' => [
        'domestic' => [
            'GS.TS.' => 'GS.TS.',
            'PGS.TS.' => 'PGS.TS.',
            'TS.' => 'TS.',
            'BSCKI.' => 'BSCKI.',
            'BSCKII.' => 'BSCKII.',
            'BS.' => 'BS.',
            'other' => 'Khác',
        ],
        'international' => [
            'Prof.' => 'Prof.',
            'Dr.' => 'Dr.',
            'MSc.' => 'MSc.',
            'BSc.' => 'BSc.',
            'Mr.' => 'Mr.',
            'Ms.' => 'Ms.',
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
