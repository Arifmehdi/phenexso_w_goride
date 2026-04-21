@extends('frontend.layouts.master')

@section('content')
<section class="container py-5">

    <!-- Page Title -->
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold text-primary">
            Website Compliance
        </h1>
        <p class="text-muted mt-2">
            Key requirements for ensuring legal and professional compliance on your website
        </p>
    </div>

    <!-- Compliance Card -->
    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-body p-4 p-md-5">

            <!-- List -->
            <ol class="mb-5 ps-3">
                <li class="mb-3">Terms and Conditions, Return and Refund Policy & Privacy Policy need to be mentioned in the Website Footer and Check Out.</li>
                <li class="mb-3">The Return and Refund Policy needs to mention a standard timeline. <span class="fw-semibold">(7 to 10 working days)</span>.</li>
                <li class="mb-3">About Us should be present in the Website Footer, along with company and management details.</li>
                <li class="mb-3">Registered address must be mentioned on the website, per trade license.</li>
                <li class="mb-3">Delivery Time needs to be mentioned on the website. <span class="fw-semibold">(Inside Dhaka - 5 days & Outside Dhaka - 10 days)</span>.</li>
                <li class="mb-3">Trade license Number / TIN Certificate Number needs to be mentioned on the website footer.</li>
                <li class="mb-3">Product stock quantity should be mentioned on the website.</li>
                <li class="mb-3">An updated payment banner should be attached to the website footer.</li>
            </ol>

            <!-- Contact Info -->
            <div class="alert alert-light border rounded-3 mb-4">
                <p class="mb-2">
                    Please, feel free to contact me. Here is my mobile number:
                    <span class="fw-bold text-dark">+8801731064826</span>
                </p>
                <p class="mb-0">
                    Warm Regards, <br>
                    <strong>Ha-meem Ahmad</strong> <br>
                    Senior Executive, E-commerce Service
                </p>
            </div>

            <!-- Address -->
            <div class="border-top pt-3">
                <p class="mb-0">
                    <i class="bi bi-geo-alt-fill text-primary me-2"></i>
                    <strong>Address:</strong> {{ $ws->website_title }}
                </p>
            </div>

        </div>
    </div>

</section>
@endsection
