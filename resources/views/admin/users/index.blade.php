@extends('admin.master')
@section('title',"Admin Dashboard | All Users")
@section('body')
    <section class="content py-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All User</h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm">
                                <input type="search" name="q"  class="global-search form-control float-right" data-url="{{ route('admin.global-search-ajax',['type'=>'user']) }}"  placeholder="Search name, email, id...">
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
                            @include('admin.users.search_data')
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
        $( document ).ready(function() {
            $(document).on("click","#selectWriter",function() {
                var that = $( this );
                var url = that.attr('data-url');
                let writer_id = that.attr('data-id');
                 $.ajax({
                     url: url,
                     data : {writer_id: writer_id },
                     method: "get",
                     success: function(result){

                      }
                });
            });

            $(document).on('keyup', ".global-search", function(e){

                e.preventDefault();
                var that = $( this );
                var url = that.attr('data-url');
                var q = that.val();

                $.ajax({
                     url: url,
                     data : {q:q},
                     method: "get",
                     success: function(res)
                     {
                        if(res.success)
                        {
                            $(".data-container").empty().append(res.html);
                        }
                     }
                });
            });
        });
    </script>
@endpush
