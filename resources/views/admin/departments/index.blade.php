@extends('admin.master')
@section('title',"Admin Dashboard | All How Works")

@section('body')
    <section class="pt-5">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All How Works</h3>
                <div class="card-tools">
                    <div class="input-group input-group-sm">
                    <input type="search" name="q"  class="global-search form-control float-right" data-url="{{ route('admin.global-search-ajax',['type'=>'department']) }}"  placeholder="Search name, id...">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                 <div class="table-responsive data-container">
                    @include('admin.departments.search_data')
                 </div>
            </div>
        </div>
    </section>
@endsection


@push('js')
    <script>
        $( document ).ready(function() {

            $('input[name=toogle]').change(function(){
                var that = $( this );
                var url  = that.attr('data-url');
                var id   = that.val()
                var mode = that.prop('checked');
                $.ajax({
                    url : url,
                    type: "POST",
                    data:{
                        _token:'{{csrf_token()}}',
                        mode:mode,
                        id:id,
                    },
                    success:function(response){
                        if(response.status){
                            alert(response.msg);
                        }
                        else{
                            alert('please try again');
                        }
                    }
                })
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
