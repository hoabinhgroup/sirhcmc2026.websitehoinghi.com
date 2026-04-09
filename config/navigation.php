<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Header main navigation
    |--------------------------------------------------------------------------
    |
    | route: tên route Laravel (bắt buộc nếu không có children — link menu chính).
    | active: tuỳ chọn — mảng pattern tên route cho request()->routeIs(...) (OR).
    |        Dùng * cho nhánh con: about.* khớp about.organizing-committee, không khớp route trang cha nếu trang cha không tồn tại.
    | children: mục cha không cần route — chỉ dùng để hiển thị dropdown; route nằm ở từng phần tử con.
    |
    */
    'header' => [
        [
            'route' => 'home',
            'label_vi' => 'Trang chủ',
            'label_en' => 'Home',
        ],
        [
            'label_vi' => 'SIR HCMC 2026',
            'label_en' => 'SIR HCMC 2026',
            'children' => [
                ['route' => 'about.organizing-committee', 'label_vi' => 'Ban tổ chức', 'label_en' => 'Organizing Committee'],
                ['route' => 'about.venue', 'label_vi' => 'Địa điểm tổ chức', 'label_en' => 'Venue'],
            ],
            'active' => ['about', 'about.*'],
        ],
        [
            'route' => 'schedule',
            'label_vi' => 'CHƯƠNG TRÌNH',
            'label_en' => 'Program',
            'active' => ['schedule', 'schedule.*'],
        ],
        [
            'route' => 'faculty',
            'label_vi' => 'CHỦ TOẠ - BÁO CÁO VIÊN',
            'label_en' => 'FACULTY',
            'active' => ['faculty', 'faculty.*'],
        ],
        [
            'label_vi' => 'ĐĂNG KÝ',
            'label_en' => 'REGISTRATION',
            'children' => [
                ['route' => 'registration.delegate-registration', 'label_vi' => 'Đăng ký tham dự', 'label_en' => 'Delegate Registration'],
                ['route' => 'registration.abstract-submission', 'label_vi' => 'Đăng ký báo cáo Abstract ', 'label_en' => 'abstract submission'],
            ],
            'active' => ['registration', 'registration.*'],
        ],
        [
            'label_vi' => 'HỖ TRỢ HẬU CẦN',
            'label_en' => 'TRAVEL SUPPORT',
            'children' => [
                ['route' => 'travel-support.vietnam-visa', 'label_vi' => 'Thị thực nhập cảnh', 'label_en' => 'Vietnam Visa'],
                ['route' => 'travel-support.transportation', 'label_vi' => 'Transportation', 'label_en' => 'Di chuyển'],
            ],
            'active' => ['travel-support', 'travel-support.*'],
        ],
        [
            'route' => 'sponsor',
            'label_vi' => 'NHÀ TÀI TRỢ',
            'label_en' => 'SPONSOR',
            'active' => ['sponsor', 'sponsor.*'],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Footer navigation (liên kết chữ — thường chỉ tiếng Anh như template gốc)
    |--------------------------------------------------------------------------
    */
    'footer' => [
        ['route' => 'home', 'label' => 'Home'],
        ['route' => 'about', 'label' => 'SIR HCMC 2026'],
        ['route' => 'schedule', 'label' => 'Program'],
        ['route' => 'faculty', 'label' => 'Faculty'],
        ['route' => 'registration', 'label' => 'Registration'],
        ['route' => 'travel-support', 'label' => 'Travel Support'],
        ['route' => 'sponsor', 'label' => 'Sponsor'],
        ['route' => 'blog', 'label' => 'Blog'],
        ['route' => 'contact', 'label' => 'Contact'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Logo đối tác (carousel footer)
    |--------------------------------------------------------------------------
    */
    'footer_partners' => [
        ['href' => '#', 'img' => 'img/partner-logo/logo-1.png'],
        ['href' => '#', 'img' => 'img/partner-logo/logo-2.png'],
        ['href' => '#', 'img' => 'img/partner-logo/logo-3.png'],
        ['href' => '#', 'img' => 'img/partner-logo/logo-4.png'],
        ['href' => '#', 'img' => 'img/partner-logo/logo-5.png'],
        ['href' => '#', 'img' => 'img/partner-logo/logo-6.png'],
    ],
];
