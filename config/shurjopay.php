<?php

return [
    /*
    |--------------------------------------------------------------------------
    | ShurjoPay credentials (bKash / Nagad / Rocket / cards via ShurjoPay gateway)
    |--------------------------------------------------------------------------
    | Sign up at https://merchant.shurjopayment.com to get real credentials.
    | Sandbox defaults below let the integration run end-to-end in dev.
    */
    'base_url' => env('SHURJOPAY_BASE_URL', 'https://sandbox.shurjopayment.com'),
    'username' => env('SHURJOPAY_USERNAME', 'sp_sandbox'),
    'password' => env('SHURJOPAY_PASSWORD', 'pyyk97hu&6u6'),
    'prefix'   => env('SHURJOPAY_PREFIX', 'GR'), // order id prefix
    'return_url' => env('SHURJOPAY_RETURN_URL', '/payment/shurjopay/callback'),
    'cancel_url' => env('SHURJOPAY_CANCEL_URL', '/payment/shurjopay/callback'),
];
