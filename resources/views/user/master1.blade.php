<!doctype html>
<html lang="en">


<!-- Mirrored from themesbrand.com/skote/layouts/vertical/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 08 Sep 2020 15:08:04 GMT -->
<head>

    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
{{--    <!-- App favicon -->--}}
{{--    <link rel="shortcut icon" href="{{asset('/')}}auth/assets/images/favicon.ico">--}}

<!-- Bootstrap Css -->
    <link href="{{asset('/')}}auth/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('/')}}auth/assets/css/icons.min.css" rel="stylesheet" type="text/css" />

    {{--Notification--}}
    <link rel="stylesheet" href="{{asset('/')}}admin/toastifyNotification/toastify.min.css">
    {{------}}

    <!-- App Css-->
    <link href="{{asset('/')}}auth/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body>
<nav class="navbar navbar-expand-md " style="background-color: #214AA2" >
    <div class="container">
        <a href="{{ url('/') }}" class="navbar-brand text-white">{{ env('APP_NAME') }}</a>
        <button type="button" class="navbar-toggler"
                data-bs-toggle="collapse" data-bs-target="#MainMenu">
            <i class="navbar-toggler-icon"></i>
        </button>
        <div class="collapse navbar-collapse" id="MainMenu" >
            <ul class="navbar-nav mx-auto">
{{--                <li class="nav-item"><a href="" class="nav-link">Home</a></li>--}}
{{--                <li class="nav-item"><a href="" class="nav-link">About</a></li>--}}
{{--                <li class="nav-item"><a href="" class="nav-link">Gallery</a></li>--}}
{{--                <li class="nav-item"><a href="" class="nav-link">Contract</a></li>--}}
            </ul>
        </div>

        @auth()
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @php
                        $name=explode(' ',\Illuminate\Support\Facades\Auth::user()->name);
                        $user=\Illuminate\Support\Facades\Auth::user();
                    @endphp
                    <span class="d-none d-xl-inline-block ml-1 font-weight-bold text-white">{{$name[0]}}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- item-->
                    @foreach($user->roles as $role)
                        @if($role->role_name == 'admin')
                            <a class="dropdown-item" href="{{route('admin.dashboard')}}"><i class="bx bx-user font-size-16 align-middle mr-1"></i> Admin Home</a>
                       
                        @endif
                    @endforeach
                    <a class="dropdown-item" href="{{route('home')}}"><i class="bx bx-user font-size-16 align-middle mr-1"></i> User Home</a>
                    <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
                        <i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> Logout
                    </a>
                    <form action="{{route('logout')}}" method="POST" id="logoutForm">
                        @csrf
                    </form>
                </div>
            </div>
        @else
            <ul class="navbar-nav text-white">
                <li class="nav-item"><a href="{{route('login')}}" class="nav-link text-white font-weight-bold text-white">Login</a></li>
{{--                <li class="nav-item"><a href="{{route('register')}}" class="nav-link">Registration</a></li>--}}
            </ul>
        @endauth
    </div>
</nav>

@yield('body')

<!-- JAVASCRIPT -->
<script src="{{asset('/')}}auth/assets/libs/jquery/jquery.min.js"></script>
<script src="{{asset('/')}}auth/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('/')}}auth/assets/libs/metismenu/metisMenu.min.js"></script>
<script src="{{asset('/')}}auth/assets/libs/simplebar/simplebar.min.js"></script>
<script src="{{asset('/')}}auth/assets/libs/node-waves/waves.min.js"></script>
{{--Notification--}}
<script src="{{asset('/')}}admin/toastifyNotification/toastify.js"></script>
{{------}}
<!-- App js -->
<script src="{{asset('/')}}auth/assets/js/app.js"></script>

<script>
    @if(Session::has('success'))
    Toastify({ text: "{{ Session::get('success') }}", duration: 3000,
        style: { background: "linear-gradient(to right, #00b09b, #96c93d)" }
    }).showToast();

    @elseif(Session::has('warning'))
    Toastify({ text: "{{ Session::get('warning') }}", duration: 3000,
        style: { background: "linear-gradient(to right, #00b09b, #96c93d)" }
    }).showToast();

    @elseif(Session::has('error'))
    Toastify({ text: "{{ Session::get('error') }}", duration: 3000,
        style: { background: "linear-gradient(to right, #00b09b, #96c93d)",
            'font-weight':'bold',
            color:'#f51804'
        }
    }).showToast();

    @endif
</script>
</body>

<!-- Mirrored from themesbrand.com/skote/layouts/vertical/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 08 Sep 2020 15:08:04 GMT -->
</html>


