@extends('frontend.layouts.pageMaster')
@section('content')
   <section class="pt-5">
     <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="mb-4">
                    <nav class="w-100 w-md-50 w-lg-30" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item ">
                            <span class="" style="font-size:20px;"> Doctor Visits ({{ $doctor->name }})</span>
                            </li>
                        </ol>
                    </nav>
                </div>
           </div>
           
           <div class="col-md-12">
            @if(Auth::user()->doctor)
            <a href="{{ route('doctor.dashboard') }}" class="btn btn-info">back</a>
            @endif
           </div>

           @include('frontend.home.parts.visits')
        </div>
     </div>
   </section>
@endsection

