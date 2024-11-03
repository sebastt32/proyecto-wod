<?php

return [
    'secret' => env('RECAPTCHA_SECRET_KEY_V2'),
    'sitekey' => env('RECAPTCHA_SITE_KEY_V2'),
    'options' => [
        'timeout' => 30,
    ],
];