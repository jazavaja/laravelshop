<?php

return [
    'name' => env('APP_NAME', 'SeoShop'),
    'manifest' => [
        'name' => env('APP_NAME', 'SeoShop'),
        'short_name' => env('APP_NAME', 'SeoShop'),
        'start_url' => '/',
        'background_color' => '#ffffff',
        'theme_color' => '#000000',
        'display' => 'standalone',
        'orientation'=> 'any',
        'status_bar'=> 'black',
        'icons' => [
            '72x72' => [
                'path' => '/pwa/ic_launcher@72x72.png',
                'purpose' => 'any'
            ],
            '96x96' => [
                'path' => '/pwa/ic_launcher@96x96.png',
                'purpose' => 'any'
            ],
            '128x128' => [
                'path' => '/pwa/ic_launcher@128x128.png',
                'purpose' => 'any'
            ],
            '144x144' => [
                'path' => '/pwa/ic_launcher@144x144.png',
                'purpose' => 'any'
            ],
            '152x152' => [
                'path' => '/pwa/ic_launcher@152x152.png',
                'purpose' => 'any'
            ],
            '192x192' => [
                'path' => '/pwa/ic_launcher@192x192.png',
                'purpose' => 'any'
            ],
            '384x384' => [
                'path' => '/pwa/ic_launcher@384x384.png',
                'purpose' => 'any'
            ],
            '512x512' => [
                'path' => '/pwa/ic_launcher@512x512.png',
                'purpose' => 'any'
            ],
        ],
        'splash' => [
            '640x1136' => '/pwa/ic_launcher@640x1136.png',
            '750x1334' => '/pwa/ic_launcher@750x1334.png',
            '828x1792' => '/pwa/ic_launcher@828x1792.png',
            '1125x2436' => '/pwa/ic_launcher@1125x2436.png',
            '1242x2208' => '/pwa/ic_launcher@1242x2208.png',
            '1242x2688' => '/pwa/ic_launcher@1242x2688.png',
            '1536x2048' => '/pwa/ic_launcher@1536x2048.png',
            '1668x2224' => '/pwa/ic_launcher@1668x2224.png',
            '1668x2388' => '/pwa/ic_launcher@1668x2388.png',
            '2048x2732' => '/pwa/ic_launcher@2048x2732.png',
        ],
        'shortcuts' => [
            [
                'name' => env('APP_NAME', 'SeoShop'),
                'description' => 'فروشگاه اینترنتی',
                'url' => '/',
                'icons' => [
                    "src" => "/pwa/ic_launcher@72x72.png",
                    "purpose" => "any"
                ]
            ],
            [
                'name' => env('APP_NAME', 'SeoShop'),
                'description' => 'فروشگاه اینترنتی',
                'url' => '/'
            ]
        ],
        'custom' => []
    ]
];
