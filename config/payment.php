<?php

return [

    'onepay_tax_rate' => 0.06,

    'merchants' => [
        'domestic' => [
            'vpc_Merchant' => env('ONEPAY_MERCHANT_DOMESTIC', 'ONEPAY'),
            'vpc_AccessCode' => env('ONEPAY_ACCESS_CODE_DOMESTIC'),
            'SECURE_SECRET' => env('ONEPAY_SECURE_SECRET_DOMESTIC'),
            'gateway_url' => env('ONEPAY_GATEWAY_DOMESTIC', 'https://mtf.onepay.vn/onecomm-pay/vpc.op'),
        ],
        'international_test' => [
            'vpc_Merchant' => env('ONEPAY_MERCHANT_TEST', 'TESTONEPAY'),
            'vpc_AccessCode' => env('ONEPAY_ACCESS_CODE_TEST', '6BEB2546'),
            'SECURE_SECRET' => env('ONEPAY_SECURE_SECRET_TEST', '6D0870CDE5F24F34F3915FB0045120DB'),
            'gateway_url' => env('ONEPAY_GATEWAY_TEST', 'https://mtf.onepay.vn/paygate/vpcpay.op'),
        ],
        'international' => [
            'vpc_Merchant' => env('ONEPAY_MERCHANT_USD', 'HOABINHTOUR2'),
            'vpc_AccessCode' => env('ONEPAY_ACCESS_CODE_USD'),
            'SECURE_SECRET' => env('ONEPAY_SECURE_SECRET_USD'),
            'gateway_url' => env('ONEPAY_GATEWAY_USD', 'https://onepay.vn/vpcpay/vpcpay.op'),
        ],
        'international_vnd' => [
            'vpc_Merchant' => env('ONEPAY_MERCHANT_VND', 'HOABINHTOURIST'),
            'vpc_AccessCode' => env('ONEPAY_ACCESS_CODE_VND'),
            'SECURE_SECRET' => env('ONEPAY_SECURE_SECRET_VND'),
            'gateway_url' => env('ONEPAY_GATEWAY_VND', 'https://onepay.vn/paygate/vpcpay.op'),
        ],
    ],

    'default_merchant' => env('ONEPAY_DEFAULT_MERCHANT', 'international_vnd'),

];
