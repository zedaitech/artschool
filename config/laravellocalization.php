<?php

return [

    /*
     |--------------------------------------------------------------------------
     | Supported Locales
     |--------------------------------------------------------------------------
     |
     | Languages the site is available in. The array key is the locale used in
     | the URL (e.g. /kn/training-centres). Add a new block here + a lang/<code>
     | directory to introduce another language — no code changes required.
     |
     */

    'supportedLocales' => [
        'en' => [
            'name' => 'English',
            'script' => 'Latn',
            'native' => 'English',
            'regional' => 'en_US',
            'flag' => '🇬🇧',
        ],
        'kn' => [
            'name' => 'Kannada',
            'script' => 'Knda',
            'native' => 'ಕನ್ನಡ',
            'regional' => 'kn_IN',
            'flag' => '🇮🇳',
        ],
    ],

    // Show the locale prefix even for the default language (/en/...). Set to
    // false to keep the default language at the root (recommended for SEO).
    'hideDefaultLocaleInURL' => false,

    'useAcceptLanguageHeader' => true,

    'localesOrder' => ['en', 'kn'],

    'localesMapping' => [],

    'utf8suffix' => env('LARAVELLOCALIZATION_UTF8SUFFIX', '.UTF-8'),

    'urlsIgnored' => ['/skipped', '/admin', '/admin/*', '/storage/*'],

];
