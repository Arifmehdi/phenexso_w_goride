@extends('frontend.layouts.pageMaster')
@section('content')
@push('css')

<script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js') }}"></script>
@endpush

 <section class="pt-3">

    <div class="container pt-3 pb-2">
        <div class="row justify-content-center">
            <div class="col-md-8">
            <div class="mb-4">
                <nav class="w-100 w-md-50 w-lg-30" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item ">
                           <span class="" style="font-size:20px;">Cahnge Paasword</span>
                        </li>
                    </ol>
                </nav>
            </div>
           </div>

        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                    @if(Auth::user()->member)
                    <a href="{{ route('agent.dashboard') }}" class="btn btn-info">back</a>
                    @elseif(Auth::user()->doctor)
                    <a href="{{ route('doctor.dashboard') }}" class="btn btn-info">back</a>
                    @elseif(auth()->user()->visits()->count())
                    <a href="{{ route('patient.dashboard') }}" class="btn btn-info">back</a>
                    @endif
            </div>
        </div>




        <div class="row pt-2 justify-content-center">
            <div class="col-lg-8">
                <form  id="updatePasswordForm" action="{{ route('member.update_password') }}" method="post">
                  @csrf
                        <div class="input-group input-group-static mb-4">
                            <label>Old Password</label>
                            <input type="password" class="form-control" id="old_password" name="old_password" data-url="{{ route('member.old_password') }}" placeholder="Enter Old Password">
                            <span id="checkOldPwd" style="font-weight: bold"></span>
                            @error('old_password')
                            <span style="color:red">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="input-group input-group-static mb-4">
                            <label>New Password</label>
                            <input type="password" class="form-control" name="new_password" id="new_password" placeholder="Enter New Password">
                            @error('new_password')
                            <span style="color:red">{{ $message }}</span>
                            @enderror
                        </div>




                        <div class="input-group input-group-static mb-4">
                            <label>Confirm password</label>
                            <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Enter Confirm Password">
                            <span id="checkOldPwd" style="font-weight: bold"></span>
                            @error('old_password')
                            <span style="color:red">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="row">
                            <div class="text-left">
                                <button type="submit" class="btn bg-gradient-primary my-4 mb-2">Change Password</button>
                            </div>
                        </div>

                </form>

            </div>
        </div>

    </div>
 </section>

@endsection

@push('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


       $( document ).ready(function() {
          $('#old_password').keyup(function(){
             var that = $(this);
             let old_pwd = $(this).val();
             let url = $(this).attr('data-url');
              $.ajax({
                url: url,
                method: 'post',
                data: { old_pwd : old_pwd },
                success: function(result){
                  if(result.success == true){
                    $('#checkOldPwd').html("<font style='color: green;'>password is correct</font>");
                  }else if(result.success == false){
                    $('#checkOldPwd').html("<font style='color: red;'>password is iscorrect</font>");
                  }
                },error:function(error){
                   console.log(error)
                }
            });
          });


          $("#updatePasswordForm").validate({
              rules: {
                new_pwd: {
                  required: true,
                  minlength: 6
                },
                confirm_password: {
                  required: true,
                  minlength: 6,
                  equalTo: "#new_password"
                },

              },
              messages: {
                new_password: {
                  required: "Please choose a password",
                  minlength: "Your password must be at least 6 characters long"
                },
                confirm_password: {
                  required: "Please choose a password",
                  minlength: "Your password must be at least 6 characters long",
                },
              }
            });


          //image show
            $('#image').change(function(e){
                var reader = new FileReader();
                reader.onload=function(e){
                    $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endpush
