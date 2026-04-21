<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from adminlte.io/themes/v3/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 19 Dec 2022 15:56:43 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{env("APP_NAME")}}</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">


    <link rel="stylesheet" href="{{asset('/')}}admin/plugins/fontawesome-free/css/all.min.css">


    <link rel="stylesheet" href="{{asset('/')}}admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

    <link rel="stylesheet" href="{{asset('/')}}admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <link rel="stylesheet" href="{{asset('/')}}admin/plugins/jqvmap/jqvmap.min.css">
    {{--    Summernote--}}
    <link rel="stylesheet" href="{{asset('/')}}admin/plugins/summernote/summernote-bs4.min.css">

    {{--    Data Table--}}
    <link rel="stylesheet" href="{{asset('/')}}admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('/')}}admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('/')}}admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    {{--    switch button--}}
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('/')}}admin/dist/css/adminlte.min2167.css?v=3.2.0">

    <link rel="stylesheet" href="{{asset('/')}}admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

    <link rel="stylesheet" href="{{asset('/')}}admin/plugins/daterangepicker/daterangepicker.css">

    {{--Notification--}}
    <link rel="stylesheet" href="{{asset('/')}}admin/toastifyNotification/toastify.min.css">
    {{------}}


    <link rel="stylesheet" href="{{asset('/')}}admin/plugins/summernote/summernote-bs4.min.css">
    <script nonce="49295efc-1990-40af-9ed8-0d65b65b8644">(function(w,d){!function(eK,eL,eM,eN){eK.zarazData=eK.zarazData||{};eK.zarazData.executed=[];eK.zaraz={deferred:[],listeners:[]};eK.zaraz.q=[];eK.zaraz._f=function(eO){return function(){var eP=Array.prototype.slice.call(arguments);eK.zaraz.q.push({m:eO,a:eP})}};for(const eQ of["track","set","debug"])eK.zaraz[eQ]=eK.zaraz._f(eQ);eK.zaraz.init=()=>{var eR=eL.getElementsByTagName(eN)[0],eS=eL.createElement(eN),eT=eL.getElementsByTagName("title")[0];eT&&(eK.zarazData.t=eL.getElementsByTagName("title")[0].text);eK.zarazData.x=Math.random();eK.zarazData.w=eK.screen.width;eK.zarazData.h=eK.screen.height;eK.zarazData.j=eK.innerHeight;eK.zarazData.e=eK.innerWidth;eK.zarazData.l=eK.location.href;eK.zarazData.r=eL.referrer;eK.zarazData.k=eK.screen.colorDepth;eK.zarazData.n=eL.characterSet;eK.zarazData.o=(new Date).getTimezoneOffset();if(eK.dataLayer)for(const eX of Object.entries(Object.entries(dataLayer).reduce(((eY,eZ)=>({...eY[1],...eZ[1]})))))zaraz.set(eX[0],eX[1],{scope:"page"});eK.zarazData.q=[];for(;eK.zaraz.q.length;){const e_=eK.zaraz.q.shift();eK.zarazData.q.push(e_)}eS.defer=!0;for(const fa of[localStorage,sessionStorage])Object.keys(fa||{}).filter((fc=>fc.startsWith("_zaraz_"))).forEach((fb=>{try{eK.zarazData["z_"+fb.slice(7)]=JSON.parse(fa.getItem(fb))}catch{eK.zarazData["z_"+fb.slice(7)]=fa.getItem(fb)}}));eS.referrerPolicy="origin";eS.src="../../cdn-cgi/zaraz/sd0d9.js?z="+btoa(encodeURIComponent(JSON.stringify(eK.zarazData)));eR.parentNode.insertBefore(eS,eR)};["complete","interactive"].includes(eL.readyState)?zaraz.init():eK.addEventListener("DOMContentLoaded",zaraz.init)}(w,d,0,"script");})(window,document);</script></head>




<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    {{--    <div class="preloader flex-column justify-content-center align-items-center">--}}
    {{--        <img class="animation__shake" src="{{asset('/')}}admin/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">--}}
    {{--    </div>--}}

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                @php
                    $name=explode(' ',\Illuminate\Support\Facades\Auth::user()->name);
                    $user=\Illuminate\Support\Facades\Auth::user();
                @endphp
                <a class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#" role="button">
                    <i class="fas fa-user-alt mr-1"></i> {{$name[0]}}
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- item-->
                    @foreach($user->roles as $role)
                        @if($role->role_name == 'admin')
                            <a class="dropdown-item" href="{{route('admin.dashboard')}}"><i class="bx bx-user font-size-16 align-middle mr-1"></i> Admin Home</a>
                        @endif
                    @endforeach
                    <a class="dropdown-item" href="{{route('dashboard')}}"><i class="bx bx-user font-size-16 align-middle mr-1"></i> user Home</a>

                    <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
                        <i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> Logout
                    </a>
                    <form action="{{route('logout')}}" method="POST" id="logoutForm">
                        @csrf
                    </form>
                </div>

            </li>
        </ul>
    </nav>


    <aside class="main-sidebar sidebar-dark-primary elevation-4">

        <a href="" class="brand-link">
{{--            <img src="{{asset('/')}}admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">--}}
            <span class="ml-5 brand-text font-weight-light font-weight-bold text-white">{{ env('APP_NAME') }}</span>
        </a>

        <div class="sidebar">

            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{asset('/')}}admin/images/avatar.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    @auth
                        <a href="#" class="d-block">{{\Illuminate\Support\Facades\Auth::user()->name}}</a>
                    @endauth
                </div>
            </div>


            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                    {{--                    User Manage--}}

                    <li class="nav-item {{ session('lsbm') == 'users'? ' menu-open ' : ''}}">
                        <a href="#" class="nav-link {{ session('lsbm') == 'users'? ' active ' : ''}}">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                User Profile
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('dashboard')}}" class="nav-link {{ session('lsbsm') == 'dashboard'? ' active ' : ''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('user.profile-edit')}}" class="nav-link {{ session('lsbsm') == 'profileEdit'? ' active ' : ''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Profile Edit</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    @if(auth()->user()->employee)

                        <li class="nav-item {{ session('lsbm') == 'emp_leaves'? ' menu-open ' : ''}}">
                            <a href="#" class="nav-link {{ session('lsbm') == 'emp_leaves'? ' active ' : ''}}">
                                <i class="nav-icon fas fa-envelope-open-text"></i>
                                <p>
                                    Leave Application
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('employee-leave.index')}}" class="nav-link {{ session('lsbsm') == 'allEmpLeaves'? ' active ' : ''}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All Leave Application</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('employee-leave.create')}}" class="nav-link {{ session('lsbsm') == 'createEmpLeave'? ' active ' : ''}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Apply for leave</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif

                </ul>
            </nav>

        </div>
    </aside>

    <div class="content-wrapper">

        <section class="content">
            <div class="container-fluid">

                @yield('body')

            </div>
        </section>

    </div>

    <footer class="main-footer">
        <strong>Copyright &copy; 2023 <a href="https://adminlte.io/">{{ env('APP_NAME') }}</a></strong>
        All rights reserved.
    </footer>

    <aside class="control-sidebar control-sidebar-dark">

    </aside>

</div>


<script src="{{asset('/')}}admin/plugins/jquery/jquery.min.js"></script>

<script src="{{asset('/')}}admin/plugins/jquery-ui/jquery-ui.min.js"></script>

{{--<script>--}}
{{--    $.widget.bridge('uibutton', $.ui.button)--}}
{{--</script>--}}

<script src="{{asset('/')}}admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="{{asset('/')}}admin/plugins/chart.js/Chart.min.js"></script>

<script src="{{asset('/')}}admin/plugins/sparklines/sparkline.js"></script>


<script src="{{asset('/')}}admin/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="{{asset('/')}}admin/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>

<script src="{{asset('/')}}admin/plugins/jquery-knob/jquery.knob.min.js"></script>

<script src="{{asset('/')}}admin/plugins/moment/moment.min.js"></script>
<script src="{{asset('/')}}admin/plugins/daterangepicker/daterangepicker.js"></script>

<script src="{{asset('/')}}admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

<script src="{{asset('/')}}admin/plugins/summernote/summernote-bs4.min.js"></script>

<script src="{{asset('/')}}admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
{{--summernote--}}
<script src="{{asset('/')}}admin/plugins/summernote/summernote-bs4.min.js"></script>
{{--Data Table--}}
<script src="{{asset('/')}}admin/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{asset('/')}}admin/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{asset('/')}}admin/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

{{--switch--}}
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

<script src="{{asset('/')}}admin/dist/js/adminlte2167.js?v=3.2.0"></script>

{{--<script src="{{asset('/')}}admin/dist/js/demo.js"></script>--}}

{{--Notification--}}
<script src="{{asset('/')}}admin/toastifyNotification/toastify.js"></script>
{{------}}
{{--summernote--}}
<script>
    $(function () {
        // Summernote
        $('#summernote').summernote()

        // CodeMirror
        CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
            mode: "htmlmixed",
            theme: "monokai"
        });
    })
</script>
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
            color:'#f51804'
        }
    }).showToast();

    @endif
</script>

<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
@yield('script')
</body>

<!-- Mirrored from adminlte.io/themes/v3/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 19 Dec 2022 15:56:48 GMT -->
</html>


