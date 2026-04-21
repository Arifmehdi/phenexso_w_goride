@extends('admin.master')
@section('title',"Admin Dashboard | All Service")

@section('body')
    <section class="pt-5">
        <div class="card" id="printArea">
            <div class="card-header">
                <h3 class="card-title">All Service</h3>
                {{-- <a href="" onclick="return printDiv('printArea');" class="btn btn-danger btn-sm ml-2 no-print">Print</a> --}}

                <script type="text/javascript">
                    function printDiv(divName) {
                        var printContents = document.getElementById(divName).innerHTML;
                        var originalContents = document.body.innerHTML;
                        document.body.innerHTML = printContents;
                        window.print();
                    }
                </script>
                <div class="card-tools no-print">
                    <div class="input-group input-group-sm">
                    <input type="search" name="q"  class="global-search form-control float-right" data-url="{{ route('admin.global-search-ajax',['type'=>'hospital']) }}"  placeholder="Search name_en, name_bn, id...">
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
                    @include('admin.service.search_data')
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
