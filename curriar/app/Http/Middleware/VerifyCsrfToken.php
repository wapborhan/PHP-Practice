<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
     protected $except = [
         '/sslcommerz/success',
         '/sslcommerz/cancel',
         '/sslcommerz/fail',
         '/sslcommerz/ipn',
         '/config_content',
         '/paytm*',
         '/payhere*',
         '/stripe*',
         '/iyzico*',
         '/payfast/checkout/notify',
         '/payfast/wallet/notify',
         '/payfast/customer_package_payment/notify'
     ];
}
