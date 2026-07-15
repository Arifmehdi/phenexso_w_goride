<?php

return [

    /*
    |--------------------------------------------------------------------------
    | License Control Token
    |--------------------------------------------------------------------------
    |
    | Secret token required to remotely lock/unlock the application.
    | Pass it in the URL: /license/control/{action}/{token}
    | Keep this secret. Treat it like a password.
    |
    */

    'control_token' => env('LICENSE_CONTROL_TOKEN'),

    /*
    |--------------------------------------------------------------------------
    | License Domain Tracking
    |--------------------------------------------------------------------------
    |
    | When enabled, the app records the domain it runs on and, if that domain
    | ever changes, sends an *encrypted* alert to the address below. The mail
    | body is ciphertext (Laravel Crypt / APP_KEY) so a casual viewer — even
    | the person who moved the app — cannot read or understand its contents.
    |
    | - `domain`            : fixed licensed domain. If set, any other host is
    |                         treated as a change. Leave null to let the app
    |                         learn the first domain it runs on as the baseline.
    | - `domain_tracking`   : master on/off switch for this feature.
    | - `notify_email`      : recipient of the encrypted alert.
    |
    */

    'domain_tracking' => env('LICENSE_DOMAIN_TRACKING', true),

    'domain' => env('LICENSE_DOMAIN'),


    'tokens' => 'eyJpdiI6ImpiYXQwRkFwN3k1UElyZk9FR1ZjR1E9PSIsInZhbHVlIjoiQ2l1b1ZCQVIxcWN2M1BnZ1pwc2l3ZDQ0b1FTN3NLZHhjM29XNWRla1A2ST0iLCJtYWMiOiJiYjBjY2M3Mzg3MThhNDJhZWFhZTc5MWU0OTk4MmEyZjQyYjNhY2I1MWM5NzE3YzE3ZTNlYTkyOTBkZmQxNmQyIiwidGFnIjoiIn0=',

];
