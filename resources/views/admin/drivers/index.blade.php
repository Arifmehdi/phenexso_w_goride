@extends('admin.master')
@section('title',"Admin Dashboard | Drivers")

@section('body')
    <section class="content py-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Drivers</h3>
                            <div class="card-tools">
                                <a href="{{ route('admin.drivers.create') }}" class="btn btn-success btn-sm mr-2">Add New Driver</a>
                                <div class="input-group input-group-sm" style="display: inline-flex; width: 250px;">
                                    <input type="search" name="q" class="global-search form-control float-right" data-url="{{ route('admin.global-search-ajax',['type'=>'driver']) }}" placeholder="Search name, email, mobile...">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-0 mb-0">
                            <div class="table-responsive data-container">
                                @include('admin.drivers.search_data')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $(document).on('keyup', ".global-search", function(e){
                e.preventDefault();
                var that = $(this);
                var url = that.attr('data-url');
                var q = that.val();

                $.ajax({
                    url: url,
                    data: {q: q},
                    method: "get",
                    success: function(res) {
                        if(res.success) {
                            $(".data-container").empty().append(res.html);
                        }
                    }
                });
            });

            // Approve / disapprove switch (delegated so it works after AJAX search)
            $(document).on('change', '.driver-approve-switch', function() {
                var $sw     = $(this);
                var approve = $sw.is(':checked');
                var url     = $sw.data('url');
                var name    = $sw.data('name');
                var $label  = $sw.siblings('label').find('.switch-label-text');

                Swal.fire({
                    title: approve ? 'Approve this rider?' : 'Set rider inactive?',
                    text: approve
                        ? name + ' will be able to receive ride requests and go online.'
                        : name + ' will be blocked from going online until approved again.',
                    icon: approve ? 'question' : 'warning',
                    showCancelButton: true,
                    confirmButtonColor: approve ? '#10713C' : '#ED1C24',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: approve ? 'Yes, approve' : 'Yes, set inactive'
                }).then(function(result) {
                    if (!result.isConfirmed) {
                        // Revert the toggle if cancelled
                        $sw.prop('checked', !approve);
                        return;
                    }

                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            approve: approve ? 1 : 0
                        },
                        success: function(res) {
                            if (res.success) {
                                $label.text(approve ? 'Approved' : 'Inactive');
                                Swal.fire({
                                    icon: 'success',
                                    title: approve ? 'Approved' : 'Set Inactive',
                                    text: res.message,
                                    timer: 2200,
                                    showConfirmButton: false
                                });
                            } else {
                                $sw.prop('checked', !approve);
                                Swal.fire('Error', res.message || 'Could not update status.', 'error');
                            }
                        },
                        error: function() {
                            $sw.prop('checked', !approve);
                            Swal.fire('Error', 'Something went wrong. Please try again.', 'error');
                        }
                    });
                });
            });
        });
    </script>
@endpush
