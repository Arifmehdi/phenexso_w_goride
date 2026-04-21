<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from adminlte.io/themes/v3/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 19 Dec 2022 15:56:43 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <!-- Favicon -->
	<link rel="shortcut icon" href="{{ route('imagecache', ['template' => 'original', 'filename' => $ws->favicon()]) }}" type="image/x-icon" />
	<link rel="apple-touch-icon" href="{{ route('imagecache', ['template' => 'original', 'filename' => $ws->favicon()]) }}">
    <link rel="icon" href="{{ route('imagecache', ['template' => 'original', 'filename' => $ws->favicon()]) }}" type="image/x-icon">


    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">

    <link rel="stylesheet" href="{{ asset('https://www.w3schools.com/w3css/4/w3.css') }}">

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


     <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('/')}}admin/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="{{asset('/')}}admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">


    {{--    switch button--}}
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('/')}}admin/dist/css/adminlte.min2167.css?v=3.2.0">

    <link rel="stylesheet" href="{{asset('/')}}admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

    <link rel="stylesheet" href="{{asset('/')}}admin/plugins/daterangepicker/daterangepicker.css">

    {{--Notification--}}
    <link rel="stylesheet" href="{{asset('/')}}admin/toastifyNotification/toastify.min.css">
    {{------}}

    <!-- ===== BOX ICONS ===== -->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="{{asset('/')}}admin/plugins/summernote/summernote-bs4.min.css">
    {{--<script nonce="49295efc-1990-40af-9ed8-0d65b65b8644">(function(w,d){!function(eK,eL,eM,eN){eK.zarazData=eK.zarazData||{};eK.zarazData.executed=[];eK.zaraz={deferred:[],listeners:[]};eK.zaraz.q=[];eK.zaraz._f=function(eO){return function(){var eP=Array.prototype.slice.call(arguments);eK.zaraz.q.push({m:eO,a:eP})}};for(const eQ of["track","set","debug"])eK.zaraz[eQ]=eK.zaraz._f(eQ);eK.zaraz.init=()=>{var eR=eL.getElementsByTagName(eN)[0],eS=eL.createElement(eN),eT=eL.getElementsByTagName("title")[0];eT&&(eK.zarazData.t=eL.getElementsByTagName("title")[0].text);eK.zarazData.x=Math.random();eK.zarazData.w=eK.screen.width;eK.zarazData.h=eK.screen.height;eK.zarazData.j=eK.innerHeight;eK.zarazData.e=eK.innerWidth;eK.zarazData.l=eK.location.href;eK.zarazData.r=eL.referrer;eK.zarazData.k=eK.screen.colorDepth;eK.zarazData.n=eL.characterSet;eK.zarazData.o=(new Date).getTimezoneOffset();if(eK.dataLayer)for(const eX of Object.entries(Object.entries(dataLayer).reduce(((eY,eZ)=>({...eY[1],...eZ[1]})))))zaraz.set(eX[0],eX[1],{scope:"page"});eK.zarazData.q=[];for(;eK.zaraz.q.length;){const e_=eK.zaraz.q.shift();eK.zarazData.q.push(e_)}eS.defer=!0;for(const fa of[localStorage,sessionStorage])Object.keys(fa||{}).filter((fc=>fc.startsWith("_zaraz_"))).forEach((fb=>{try{eK.zarazData["z_"+fb.slice(7)]=JSON.parse(fa.getItem(fb))}catch{eK.zarazData["z_"+fb.slice(7)]=fa.getItem(fb)}}));eS.referrerPolicy="origin";eS.src="../../cdn-cgi/zaraz/sd0d9.js?z="+btoa(encodeURIComponent(JSON.stringify(eK.zarazData)));eR.parentNode.insertBefore(eS,eR)};["complete","interactive"].includes(eL.readyState)?zaraz.init():eK.addEventListener("DOMContentLoaded",zaraz.init)}(w,d,0,"script");})(window,document);</script> --}}    
    </head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>

            <li class="nav-item">
               <a class="nav-link" target="_blank"  href="{{ url('/') }}" style="color:rgb(119, 154, 250)">
                  <i class="fas fa-globe"></i>
                </a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown">
                @php
                    $name=explode(' ',\Illuminate\Support\Facades\Auth::user()->name);
                    $user=\Illuminate\Support\Facades\Auth::user();
                @endphp
                <a class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#" role="button">
                    <i class="fas fa-user-alt mr-1"></i>{{$name[0]}}
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- item-->
                    @foreach($user->roles as $role)
                        @if($role->role_name == 'admin')
                            <a class="dropdown-item" href="{{route('admin.dashboard')}}"><i class="bx bx-user font-size-16 align-middle mr-1"></i>Admin DashBoard</a>
                        @endif
                    @endforeach
                     

                    <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
                        <i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> Logout
                    </a>
                    <form action="{{route('logout')}}" method="get" id="logoutForm">
                        @csrf
                    </form>
                </div>

            </li>
        </ul>
    </nav>


    <aside class="main-sidebar sidebar-dark-primary elevation-4">

        <div class="sidebar">

            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{asset('/')}}admin/images/avatar.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="{{route('admin.dashboard')}}" class="d-block">{{$name[0]}}</a>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column pb-5" data-widget="treeview" role="menu" data-accordion="false">


                    <li class="nav-item {{ session('lsbm') == 'dashboardM'? ' menu-open ' : ''}}">
                        <a href="Javascript:void()" class="nav-link {{ session('lsbm') == 'dashboardM'? ' active ' : ''}}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                DashBoard
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.dashboard')}}" class="nav-link {{ session('lsbsm') == 'dashboardSM'? ' active ' : ''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Admin DashBoard</p>
                                </a>
                            </li>
                           
                        </ul>
                    </li>



                    <li class="nav-item {{ session('lsbm') == 'users'? ' menu-open ' : ''}}">
                        <a href="#" class="nav-link {{ session('lsbm') == 'users'? ' active ' : ''}}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Users
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.user')}}" class="nav-link {{ session('lsbsm') == 'allUsers'? ' active ' : ''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All User 02563</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.create-user')}}" class="nav-link {{ session('lsbsm') == 'createUser'? ' active ' : ''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create User</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item {{ session('lsbm') == 'roles'? ' menu-open ' : ''}}">
                        <a href="#" class="nav-link {{ session('lsbm') == 'roles'? ' active ' : ''}}">
                            <i class="nav-icon fas fa-diagnoses"></i>
                            <p>
                               Role Management
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.manage-role')}}" class="nav-link {{ session('lsbsm') == 'allRoles'? ' active ' : ''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Manage User Role</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.assign-role')}}" class="nav-link {{ session('lsbsm') == 'assignRole'? ' active ' : ''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Assign User Role</p>
                                </a>
                            </li>
                        </ul>
                    </li>


                    <li class="nav-item {{ session('lsbm') == 'slider'? ' menu-open ' : ''}}">
                        <a href="#" class="nav-link {{ session('lsbm') == 'slider'? ' active ' : ''}}">
                            <i class="nav-icon fas fa-search-location"></i>
                            <p>
                                Sliders
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('sliders.index') }}" class="nav-link {{ session('lsbsm') == 'allFrontSlider' ? ' active ' : ''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Sliders</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                   

                    <li class="nav-item {{ session('lsbm') == 'menupage' ? ' menu-open ' : ''}}">
                        <a href="#" class="nav-link {{ session('lsbm') == 'menupage' ? ' active ' : ''}}">
                            <i class="nav-icon fas fa-bezier-curve"></i>
                            <p>
                                Menus & Pages
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{route('admin.menusAll')}}" class="nav-link {{ session('lsbsm') == 'menusAll' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Menus</p>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="{{route('admin.pagesAll')}}" class="nav-link {{ session('lsbsm') == 'pagesAll' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All pages</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                    {{--<li class="nav-item {{ session('lsbm') == 'categories'? ' menu-open ' : ''}}">
                        <a href="#" class="nav-link {{ session('lsbm') == 'categories'? ' active ' : ''}}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Category
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('categories.index')}}" class="nav-link {{ session('lsbsm') == 'allDoctors' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Category</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('categories.create')}}" class="nav-link {{ session('lsbsm') == 'createDoctors' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create Category</p>
                                </a>
                            </li>

                        </ul>
                    </li>--}}

                    {{--<li class="nav-item {{ session('lsbm') == 'services'? ' menu-open ' : ''}}">
                        <a href="#" class="nav-link {{ session('lsbm') == 'services'? ' active ' : ''}}">
                            <i class="nav-icon fas fa-passport"></i>
                            <p>
                                Service
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('services.index')}}" class="nav-link {{ session('lsbsm') == 'allHospitals' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Service</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('services.create')}}" class="nav-link {{ session('lsbsm') == 'createHospitals' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create Service</p>
                                </a>
                            </li>

                        </ul>
                    </li>--}}

                    <li class="nav-item {{ session('lsbm') == 'departments'? ' menu-open ' : ''}}">
                        <a href="#" class="nav-link {{ session('lsbm') == 'departments'? ' active ' : ''}}">
                            <i class="nav-icon fas fa-passport"></i>
                            <p>
                                How Works
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('departments.index')}}" class="nav-link {{ session('lsbsm') == 'alldepartments' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All How Works</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('departments.create')}}" class="nav-link {{ session('lsbsm') == 'createdepartments' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create How Works</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                    {{--<li class="nav-item {{ session('lsbm') == 'chambers'? ' menu-open ' : ''}}">
                        <a href="#" class="nav-link {{ session('lsbm') == 'chambers'? ' active ' : ''}}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Chambers
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('chambers.index')}}" class="nav-link {{ session('lsbsm') == 'allchambers' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Chambers</p>
                                </a>
                            </li>
                        </ul>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('chambers.create')}}" class="nav-link {{ session('lsbsm') == 'createchambers' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create Chamber</p>
                                </a>
                            </li>

                        </ul>
                    </li>--}}


                    <li class="nav-item {{ session('lsbm') == 'mediaM'? ' menu-open ' : ''}}">
                        <a href="#" class="nav-link {{ session('lsbm') == 'mediaM'? ' active ' : ''}}">
                            <i class="nav-icon fas fa-pager"></i>
                            <p>
                                Media
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('medias.index') }}" class="nav-link {{ session('lsbsm') == 'mediaSM'? ' active ' : ''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Media</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item {{ session('lsbm') == 'posts'? ' menu-open ' : ''}}">
                        <a href="#" class="nav-link {{ session('lsbm') == 'posts'? ' active ' : ''}}">
                            <i class="nav-icon far fa-share-square"></i>
                            <p>
                                News
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{route('categories.index')}}" class="nav-link {{ session('lsbsm') == 'allCategories' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All  Category</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{route('categories.create')}}" class="nav-link {{ session('lsbsm') == 'createCategory' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create  Category</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{route('news.index')}}" class="nav-link {{ session('lsbsm') == 'allPosts' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All News</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('news.create')}}" class="nav-link {{ session('lsbsm') == 'storePost' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create News</p>
                                </a>
                            </li>

                        </ul>
                    </li>


                   {{-- <li class="nav-item {{ session('lsbm') == 'ambulances'? ' menu-open ' : ''}}">
                        <a href="#" class="nav-link {{ session('lsbm') == 'ambulances'? ' active ' : ''}}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Ambulance Services
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('ambulances.index')}}" class="nav-link {{ session('lsbsm') == 'allAmbulances' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Ambulance Services</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('ambulances.create')}}" class="nav-link {{ session('lsbsm') == 'createAmbulance' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create Ambulance Service</p>
                                </a>
                            </li>

                        </ul>
                    </li>--}}


                    <li class="nav-item {{ session('lsbm') == 'galleries' ? ' menu-open ' : '' }}">
                        <a href="#" class="nav-link {{ session('lsbm') == 'galleries' ? ' active ' : '' }}">
                            <i class="nav-icon fas fas fa-bell"></i>
                            <p>
                                Galleries
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('galleries.index') }}"
                                    class="nav-link {{ session('lsbsm') == 'all_gallery' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Galleries</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('galleries.create') }}"
                                    class="nav-link {{ session('lsbsm') == 'create_gallery' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create Gallery</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-item {{ session('lsbm') == 'testimonials' ? ' menu-open ' : ''}}">
                        <a href="#" class="nav-link {{ session('lsbm') == 'testimonials' ? ' active ' : ''}}">
                            <i class="nav-icon fas fa-quote-right"></i>
                            <p>
                                Testimonials
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('testimonials.index') }}" class="nav-link {{ session('lsbsm') == 'testimonialsAll' ? ' active ' : ''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Testimonials</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('testimonials.create') }}" class="nav-link {{ session('lsbsm') == 'createTestimonial' ? ' active ' : ''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create Testimonial</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{--<li class="nav-item {{ session('lsbm') == 'appointments'? ' menu-open ' : ''}}">
                        <a href="#" class="nav-link {{ session('lsbm') == 'appointments'? ' active ' : ''}}">
                            <i class="nav-icon fas fa-pager"></i>
                            <p>
                               Appointment List
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('allAppointments') }}" class="nav-link {{ session('lsbsm') == 'allAppointments'? ' active ' : ''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Appointments</p>
                                </a>
                            </li>

                        </ul>
                    </li>--}}


                    {{-- Products --}}
                    <li class="nav-item {{ session('lsbm') == 'product'? ' menu-open ' : ''}}">
                        <a href="#" class="nav-link {{ session('lsbm') == 'product'? ' active ' : ''}}">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>
                                Products
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.productCategoriesAll') }}" class="nav-link {{ session('lsbsm') == 'productCategoriesAll' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Categories All</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.productsAll') }}" class="nav-link {{ session('lsbsm') == 'productsAll' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Products All</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                                            
                        {{-- Vehicles --}}
                    <li class="nav-item {{ session('lsbm') == 'vehicles'? ' menu-open ' : ''}}">
                        <a href="#" class="nav-link {{ session('lsbm') == 'vehicles'? ' active ' : ''}}">
                            <i class="nav-icon fas fa-truck"></i> {{-- Using a truck icon for vehicles --}}
                            <p>
                                Vehicles
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.vehicles.index') }}" class="nav-link {{ session('lsbsm') == 'allVehicles' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Vehicles</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.vehicles.create') }}" class="nav-link {{ session('lsbsm') == 'createVehicle' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add Vehicle</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- Drivers --}}
                    <li class="nav-item {{ session('lsbm') == 'drivers'? ' menu-open ' : ''}}">
                        <a href="#" class="nav-link {{ session('lsbm') == 'drivers'? ' active ' : ''}}">
                            <i class="nav-icon fas fa-user-friends"></i> {{-- Using a user-friends icon for drivers --}}
                            <p>
                                Drivers
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.drivers.index') }}" class="nav-link {{ session('lsbsm') == 'allDrivers' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Drivers</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.drivers.create') }}" class="nav-link {{ session('lsbsm') == 'createDriver' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add Driver</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- Vehicle Assignments --}}
                    <li class="nav-item {{ session('lsbm') == 'vehicle_assignments'? ' menu-open ' : ''}}">
                        <a href="#" class="nav-link {{ session('lsbm') == 'vehicle_assignments'? ' active ' : ''}}">
                            <i class="nav-icon fas fa-clipboard-list"></i>
                            <p>
                                Vehicle Assignments
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.vehicle_assignments.index') }}" class="nav-link {{ session('lsbsm') == 'allVehicleAssignments' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Assignments</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.vehicle_assignments.create') }}" class="nav-link {{ session('lsbsm') == 'createVehicleAssignment' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>New Assignment</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- Product Stock Requests --}}
                    <li class="nav-item {{ session('lsbm') == 'stock_requests' ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ session('lsbm') == 'stock_requests' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-boxes"></i>
                            <p>
                            Stock Requests
                            <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                            <a href="{{ route('admin.stock_requests.index') }}" class="nav-link {{ session('lsbsm') == 'allStockRequests' ? 'active' : '' }}">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>All Stock Requests</p>
                            </a>
                            </li>
                        </ul>
                    </li>

                    {{-- Orders --}}
                    <li class="nav-item {{ session('lsbm') == 'order' ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ session('lsbm') == 'order' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-shopping-bag"></i>
                            <p>
                            Orders
                            <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                            <a href="{{ route('admin.orderList') }}" class="nav-link {{ session('lsbsm') == 'orderList' ? 'active' : '' }}">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Order List</p>
                            </a>
                            </li>
                        </ul>
                    </li>

                    {{-- Contact Messages --}}
                    <li class="nav-item {{ session('lsbm') == 'contacts' ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ session('lsbm') == 'contacts' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-shopping-bag"></i>
                            <p>
                            Contact
                            <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                            <a href="{{ route('admin.contacts.index') }}" class="nav-link {{ session('lsbsm') == 'contactListAll' ? 'active' : '' }}">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Contact Message</p>
                            </a>
                            </li>
                        </ul>
                    </li>

                   <li class="nav-item {{ session('lsbm') == 'shipping' ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ session('lsbm') == 'shipping' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-shopping-bag"></i>
                            <p>
                            Shipping Method
                            <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                            <a href="{{ route('shipping.index') }}" class="nav-link {{ session('lsbsm') == 'shippingMethod' ? 'active' : '' }}">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Method List</p>
                            </a>
                            </li>
                        </ul>
                    </li>
                   
                   

                    <li class="nav-item {{ session('lsbm') == 'websiteparam'? ' menu-open ' : ''}}">
                        <a href="#" class="nav-link {{ session('lsbm') == 'websiteparam'? ' active ' : ''}}">
                            <i class="nav-icon fas fa-desktop"></i>
                            <p>
                                 Website Settings
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('websiteparam')}}" class="nav-link {{ session('lsbsm') == 'websiteparamSM'? ' active ' : ''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Website Settings</p>
                                </a>
                            </li>

                        </ul>
                    </li>
              
              
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
        <strong>Copyright &copy; {{ date('Y')}} <a href="javascript:void(0)">Phenex Soft.</a></strong>
        All rights reserved.
    </footer>

    <aside class="control-sidebar control-sidebar-dark">

    </aside>

</div>


<script src="{{asset('/')}}admin/plugins/jquery/jquery.min.js"></script>

<script src="{{asset('/')}}admin/plugins/jquery-ui/jquery-ui.min.js"></script>


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

<!-- include codemirror (codemirror.css, codemirror.js, xml.js, formatting.js)-->
  <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/codemirror.min.css" />
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/theme/blackboard.min.css">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/theme/monokai.min.css">
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/codemirror.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/mode/xml/xml.min.js"></script>


{{--Data Table--}}
<script src="{{asset('/')}}admin/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{asset('/')}}admin/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{asset('/')}}admin/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Select2 -->
<script src="{{asset('/')}}admin/plugins/select2/js/select2.full.min.js"></script>

{{--switch--}}
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

<script src="{{asset('/')}}admin/dist/js/adminlte2167.js?v=3.2.0"></script>

{{--<script src="{{asset('/')}}admin/dist/js/demo.js"></script>--}}

{{--Notification--}}
<script src="{{asset('/')}}admin/toastifyNotification/toastify.js"></script>
{{------}}



<!--===== SORTABLE JS =====-->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

{{--summernote--}}
<script>
    $(function () {
        // Summernote
        $('#summernote').summernote({
            height: 200,
            tabsize: 2,
            codemirror: {
            mode: 'text/html',
            htmlMode: true,
            lineNumbers: true,
            theme: 'monokai'
            }
        });


        $('#summernote1').summernote({
            height: 200,
            tabsize: 2,
            codemirror: {
            mode: 'text/html',
            htmlMode: true,
            lineNumbers: true,
            theme: 'monokai'
            }
        });


        // $('.select2bs4').select2({
        //     theme: 'bootstrap4'
        // })


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

<script>
    /*===== DRAG and DROP =====*/
    const dropItems = document.getElementById('drop-items')

    new Sortable(dropItems, {
        animation: 350,
        chosenClass: "sortable-chosen",
        dragClass: "sortable-drag",
        store: {
            // We keep the order of the list
            set: (sortable) =>{
                const order = sortable.toArray()
                localStorage.setItem(sortable.options.group.name, order.join('|'))
            },

            // We get the order of the list
            get: (sortable) =>{
                const order = localStorage.getItem(sortable.options.group.name)
                return order ? order.split('|') : []
            }
        }
    });
</script>

@stack('js')
</body>

</html>

