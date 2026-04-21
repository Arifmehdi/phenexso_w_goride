<?php

$apiDomain = env('SSLCZ_TESTMODE', true)
    ? "https://sandbox.sslcommerz.com"
    : "https://securepay.sslcommerz.com";

return [

    /*
    |--------------------------------------------------------------------------
    | API Credentials
    |--------------------------------------------------------------------------
    */
    'apiCredentials' => [
        'store_id'       => env('SSLCZ_TESTMODE', true)
                                ? env('SSLCZ_STORE_ID_TEST', '')
                                : env('SSLCZ_STORE_ID_LIVE', ''),
        'store_password' => env('SSLCZ_TESTMODE', true)
                                ? env('SSLCZ_STORE_PASSWORD_TEST', '')
                                : env('SSLCZ_STORE_PASSWORD_LIVE', ''),
    ],

    /*
    |--------------------------------------------------------------------------
    | API Endpoints
    |--------------------------------------------------------------------------
    */
    'apiUrl' => [
        'make_payment'       => "/gwprocess/v4/api.php",
        'transaction_status' => "/validator/api/merchantTransIDvalidationAPI.php",
        'order_validate'     => "/validator/api/validationserverAPI.php",
        'refund_payment'     => "/validator/api/merchantTransIDvalidationAPI.php",
        'refund_status'      => "/validator/api/merchantTransIDvalidationAPI.php",
    ],

    /*
    |--------------------------------------------------------------------------
    | API Domain
    |--------------------------------------------------------------------------
    */
    'apiDomain' => $apiDomain,

    /*
    |--------------------------------------------------------------------------
    | Localhost Connection
    |--------------------------------------------------------------------------
    */
    'connect_from_localhost' => env("IS_LOCALHOST", true),

    /*
    |--------------------------------------------------------------------------
    | Default Appointment Callback URLs
    |--------------------------------------------------------------------------
    */
    'success_url' => '/success',
	'failed_url' => '/fail',
	'cancel_url' => '/cancel',
	'ipn_url' => '/ipn',

    /*
    |--------------------------------------------------------------------------
    | Order Payment Callback URLs
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Currency
    |--------------------------------------------------------------------------
    */
    'currency' => 'BDT',

    /*
    |--------------------------------------------------------------------------
    | Payment Type
    |--------------------------------------------------------------------------
    */
    'payment_type' => 'hosted',
];
