@extends('frontend.layouts.pageMaster')
@section('content')
@if ($contactUsPage->id == $page->id)
 <section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-7  d-flex flex-column ms-auto me-auto ms-lg-auto">
                <div class="card d-flex blur justify-content-center shadow-lg my-sm-0 my-sm-6 mt-8 mb-5">
                    <div class="card-body">
                        @foreach ($page->pageItems as $item)
                         <p>{!! $item->description !!}</p>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-5 d-flex flex-column ms-auto me-auto ms-lg-auto">
                <div class="card d-flex blur justify-content-center shadow-lg my-sm-0 my-sm-6 mt-8 mb-5">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                        <div class="bg-gradient-success shadow-primary border-radius-lg p-3">
                            <h3 class="text-white text-primary mb-0">Contact us</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="contact-form" action="{{ route('contactUs') }}" method="post"
                            autocomplete="off">
                            @csrf

                            @if ($errors->any())
                            <div class="alert alert-danger">
                               <span style="color:white"> Please fill all the fields</span>
                            </div>
                            @endif

                            <div class="card-body p-0 my-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Full Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Full Name"
                                                name="full_name">
                                        </div>
                                    </div>
                                    <div class="col-md-6 ps-md-2">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Email</label>
                                            <input type="email" class="form-control"
                                                placeholder="Enter Email" name="email">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Number</label>
                                            <input type="number" class="form-control" placeholder="Enter Number"
                                                name="number">
                                        </div>
                                    </div>
                                    <div class="col-md-6 ps-md-2">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Subject</label>
                                            <input type="text" class="form-control"
                                                placeholder="Enter Subject" name="subject">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-0 mt-md-0 mt-4">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Message</label>
                                        <textarea class="form-control" id="message" rows="3"
                                            placeholder="Enter message"
                                            name="message"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn bg-gradient-success mt-3 mb-0 form-control">Send
                                            Message</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
 </section>
    <section>
        <div class="container-fluid">
            <div class="card bg-white">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-">
                                <div class="card-body text-center m-0 p-0">
                                    <h6>Contact Number</h6>

                                    <p>{{$websiteParameter->contact_mobile}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-">
                                <div class="card-body text-center m-0 p-0">
                                    <h6>Email Address</h6>
                                    <p>
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                        {{$websiteParameter->contact_email}} <br>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

@else

<section>
    <div class="container pt-5">
        @foreach ($page->pageItems as $item)
            <p>{!! $item->description !!}</p>
        @endforeach
    </div>
</section>

 @endif

@endsection
