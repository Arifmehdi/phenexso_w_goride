@extends('frontend.layouts.ecommercemaster')
@section('title', 'About Us')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h1>About Us</h1>

            <h2>Company Details</h2>
            <p>93-Shasthoseba Foundation is working tirelessly to ensure uninterrupted healthcare for all the marginalized. The activities of this foundation are being run by SSC 93 batch doctors and other friends. During the past Covid-19 pandemic, we tried to provide online medical services to everyone with the help of some 93 friends and doctors. As a result, today this foundation has extended its service to all the marginalized groups of the society. Hopefully, this effort of 93-Healthcare Foundation will continue. We wish everyone good health and all-round well-being.</p>

            <h2>Management Team</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <h5 class="card-title">[Name]</h5>
                            <p class="card-text">[Position]</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <h5 class="card-title">[Name]</h5>
                            <p class="card-text">[Position]</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <h5 class="card-title">[Name]</h5>
                            <p class="card-text">[Position]</p>
                        </div>
                    </div>
                </div>
            </div>

            <h2>Frequently Asked Questions</h2>
            <div class="accordion" id="about-us-accordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="who-we-are-heading">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#who-we-are-collapse" aria-expanded="true" aria-controls="who-we-are-collapse">
                            Who we are?
                        </button>
                    </h2>
                    <div id="who-we-are-collapse" class="accordion-collapse collapse show" aria-labelledby="who-we-are-heading" data-bs-parent="#about-us-accordion">
                        <div class="accordion-body">
                            93-Shasthoseba Foundation is working tirelessly to ensure uninterrupted healthcare for all the marginalized. The activities of this foundation are being run by SSC 93 batch doctors and other friends. During the past Covid-19 pandemic, we tried to provide online medical services to everyone with the help of some 93 friends and doctors. As a result, today this foundation has extended its service to all the marginalized groups of the society. Hopefully, this effort of 93-Healthcare Foundation will continue. We wish everyone good health and all-round well-being.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="our-services-heading">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#our-services-collapse" aria-expanded="false" aria-controls="our-services-collapse">
                            Our Services
                        </button>
                    </h2>
                    <div id="our-services-collapse" class="accordion-collapse collapse" aria-labelledby="our-services-heading" data-bs-parent="#about-us-accordion">
                        <div class="accordion-body">
                            93-Shasthoseba Foundation is working tirelessly to ensure uninterrupted healthcare for all the marginalized. This foundation is being run by SSC 93 batch doctors and other friends. During the past Covid-19 pandemic, we tried to provide online medical services to everyone with the help of some 93 friends and doctors. As a result, today this foundation has extended its service to all the marginalized groups of the society. Hopefully, this effort of 93-Healthcare Foundation will continue. We wish everyone good health and all-round well-being.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="qualified-doctors-heading">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#qualified-doctors-collapse" aria-expanded="false" aria-controls="qualified-doctors-collapse">
                            Qualified Doctors
                        </button>
                    </h2>
                    <div id="qualified-doctors-collapse" class="accordion-collapse collapse" aria-labelledby="qualified-doctors-heading" data-bs-parent="#about-us-accordion">
                        <div class="accordion-body">
                            93-Shasthoseba Foundation is working tirelessly to ensure uninterrupted healthcare for all the marginalized. This foundation is being run by SSC 93 batch doctors and other friends. During the past Covid-19 pandemic, we tried to provide online medical services to everyone with the help of some 93 friends and doctors. As a result, today this foundation has extended its service to all the marginalized groups of the society. Hopefully, this effort of 93-Healthcare Foundation will continue. We wish everyone good health and all-round well-being.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection