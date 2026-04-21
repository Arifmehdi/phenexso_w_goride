<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        // SSLCommerz AJAX or Hosted payment callbacks
        '/pay-via-ajax',
        '/pay',

        // SSLCommerz Standard callbacks
        '/success',
        '/fail',
        '/cancel',
        '/ipn',
        'order/*',
    ];

}
