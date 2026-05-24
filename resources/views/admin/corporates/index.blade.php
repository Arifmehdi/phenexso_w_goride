@extends('admin.master')
@section('title',"Admin Dashboard | Corporates")

@section('body')
    <section class="content py-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Corporates</h3>
                            <div class="card-tools">
                                <a href="{{ route('admin.corporates.create') }}" class="btn btn-success btn-sm mr-2">Add New Corporate</a>
                                <div class="input-group input-group-sm" style="display: inline-flex; width: 250px;">
                                    <input type="search" name="q" class="global-search form-control float-right" data-url="{{ route('admin.global-search-ajax',['type'=>'corporate']) }}" placeholder="Search name, company, email...">
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
                                @include('admin.corporates.search_data')
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
        });
    </script>
@endpush
