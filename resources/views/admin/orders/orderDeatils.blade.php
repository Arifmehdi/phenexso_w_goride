@extends('admin.master')

@section('title')
  Admin Dashboard  | Order List
@endsection

@push('css')
<!-- Custom CSS section: Add custom styles here if needed -->
@endpush

@section('body')
<section class="content py-3">
    <div class="row">
        <div class="col-md-11 mx-auto">

            {{-- Order page top header section --}}
            @include('admin.orders.sections.order_header')

            {{-- Main container card --}}
            <div class="card w3-round mb-2 shadow-lg">
                <div class="card-body px-2 py-2 w3-light-gray">

                    {{-- Order and user information --}}
                    @include('admin.orders.sections.order_info', ['order' => $order])
                        
                    {{-- Check if order has any items --}}
                    {{-- @if($order->orderItems()->count() > 0) --}}

                     
                        @include('admin.orders.sections.order_status_form', ['order' => $order])

                        @include('admin.orders.sections.assign_driver', ['order' => $order, 'drivers' => $drivers, 'vehicles' => $vehicles])

                        {{-- List of all ordered items --}}
                        @include('admin.orders.sections.order_items', ['order' => $order])

                        {{-- Show payment form only if order has due --}}
                        @if($order->due() > 0)
                            @include('admin.orders.sections.order_payment_form', ['order' => $order])    
                        @endif

                        {{-- Display payment/transaction history --}}
                        @include('admin.orders.sections.transaction_history', ['order' => $order])

                 
                </div>
            </div>

        </div>
    </div>
</section>


@endsection

@push('js')
{{-- JS script section for handling all AJAX and interactions --}}
@include('admin.orders.scripts.order_details_script')
@endpush
