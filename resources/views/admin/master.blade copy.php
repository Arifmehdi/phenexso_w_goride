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
    <script nonce="49295efc-1990-40af-9ed8-0d65b65b8644">(function(w,d){!function(eK,eL,eM,eN){eK.zarazData=eK.zarazData||{};eK.zarazData.executed=[];eK.zaraz={deferred:[],listeners:[]};eK.zaraz.q=[];eK.zaraz._f=function(eO){return function(){var eP=Array.prototype.slice.call(arguments);eK.zaraz.q.push({m:eO,a:eP})}};for(const eQ of["track","set","debug"])eK.zaraz[eQ]=eK.zaraz._f(eQ);eK.zaraz.init=()=>{var eR=eL.getElementsByTagName(eN)[0],eS=eL.createElement(eN),eT=eL.getElementsByTagName("title")[0];eT&&(eK.zarazData.t=eL.getElementsByTagName("title")[0].text);eK.zarazData.x=Math.random();eK.zarazData.w=eK.screen.width;eK.zarazData.h=eK.screen.height;eK.zarazData.j=eK.innerHeight;eK.zarazData.e=eK.innerWidth;eK.zarazData.l=eK.location.href;eK.zarazData.r=eL.referrer;eK.zarazData.k=eK.screen.colorDepth;eK.zarazData.n=eL.characterSet;eK.zarazData.o=(new Date).getTimezoneOffset();if(eK.dataLayer)for(const eX of Object.entries(Object.entries(dataLayer).reduce(((eY,eZ)=>({...eY[1],...eZ[1]})))))zaraz.set(eX[0],eX[1],{scope:"page"});eK.zarazData.q=[];for(;eK.zaraz.q.length;){const e_=eK.zaraz.q.shift();eK.zarazData.q.push(e_)}eS.defer=!0;for(const fa of[localStorage,sessionStorage])Object.keys(fa||{}).filter((fc=>fc.startsWith("_zaraz_"))).forEach((fb=>{try{eK.zarazData["z_"+fb.slice(7)]=JSON.parse(fa.getItem(fb))}catch{eK.zarazData["z_"+fb.slice(7)]=fa.getItem(fb)}}));eS.referrerPolicy="origin";eS.src="../../cdn-cgi/zaraz/sd0d9.js?z="+btoa(encodeURIComponent(JSON.stringify(eK.zarazData)));eR.parentNode.insertBefore(eS,eR)};["complete","interactive"].includes(eL.readyState)?zaraz.init():eK.addEventListener("DOMContentLoaded",zaraz.init)}(w,d,0,"script");})(window,document);</script></head>




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
                            <a class="dropdown-item" href="{{route('admin.dashboard')}}"><i class="bx bx-user font-size-16 align-middle mr-1"></i>Admin</a>
                     
                        @endif
                    @endforeach
                     {{-- <a class="dropdown-item" href="{{route('dashboard')}}"><i class="bx bx-user font-size-16 align-middle mr-1"></i> user Home</a> --}}

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
                                    <p>DashBoard</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{route('websiteparam')}}" class="nav-link {{ session('lsbsm') == 'websiteparamSM'? ' active ' : ''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Website Parameter</p>
                                </a>
                            </li>
                        </ul>
                    </li>



                    <li class="nav-item {{ session('lsbm') == 'users'? ' menu-open ' : ''}}">
                        <a href="#" class="nav-link {{ session('lsbm') == 'users'? ' active ' : ''}}">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                User Manage
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.user')}}" class="nav-link {{ session('lsbsm') == 'allUsers'? ' active ' : ''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All User</p>
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
                                User Role
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

                    <li class="nav-item {{ session('lsbm') == 'menus' ? ' menu-open ' : ''}}">
                        <a href="#" class="nav-link {{ session('lsbm') == 'menus' ? ' active ' : ''}}">
                            <i class="nav-icon fas fa-bezier-curve"></i>
                            <p>
                                Menus & Pages
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{route('menus.create')}}" class="nav-link {{ session('lsbsm') == 'createMenu' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Menus</p>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="{{route('pages.create')}}" class="nav-link {{ session('lsbsm') == 'createPages' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All pages</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-item {{ session('lsbm') == 'journal_categories'? ' menu-open ' : ''}}">
                        <a href="#" class="nav-link {{ session('lsbm') == 'journal_categories'? ' active ' : ''}}">
                            <i class="nav-icon fas fa-passport"></i>
                            <p>
                                Category & SubCategory
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('blog-categories.index')}}" class="nav-link {{ session('lsbsm') == 'alljournalCategories' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All  Category</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('blog-categories.create')}}" class="nav-link {{ session('lsbsm') == 'createjournalCategory' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create  Category</p>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="{{route('blog-sub-categories.index')}}" class="nav-link {{ session('lsbsm') == 'alljournalSubCategories' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All  Sub Category</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('blog-sub-categories.create')}}" class="nav-link {{ session('lsbsm') == 'createjournalsubCategory' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create  Sub Category</p>
                                </a>
                            </li>

                        </ul>
                    </li>





                    <li class="nav-item {{ session('lsbm') == 'bisesoggo_categories'? ' menu-open ' : ''}}">
                        <a href="#" class="nav-link {{ session('lsbm') == 'bisesoggo_categories'? ' active ' : ''}}">
                            <i class="nav-icon fas fa-passport"></i>
                            <p>
                                Bisesoggo Category
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('bisesoggo_categories.index')}}" class="nav-link {{ session('lsbsm') == 'allBisesoggoCategories' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All  Bisesoggo Categories</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('bisesoggo_categories.create')}}" class="nav-link {{ session('lsbsm') == 'createBisesoggoCategories' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create Bisesoggo Category</p>
                                </a>
                            </li>

                        </ul>
                    </li>



                    <li class="nav-item {{ session('lsbm') == 'hospitals'? ' menu-open ' : ''}}">
                        <a href="#" class="nav-link {{ session('lsbm') == 'hospitals'? ' active ' : ''}}">
                            <i class="nav-icon fas fa-passport"></i>
                            <p>
                                Hospital
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('hospitals.index')}}" class="nav-link {{ session('lsbsm') == 'allHospitals' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Hospitals</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('hospitals.create')}}" class="nav-link {{ session('lsbsm') == 'createHospitals' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create Hospital</p>
                                </a>
                            </li>

                        </ul>
                    </li>



                    <li class="nav-item {{ session('lsbm') == 'doctors'? ' menu-open ' : ''}}">
                        <a href="#" class="nav-link {{ session('lsbm') == 'doctors'? ' active ' : ''}}">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                               Doctor
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('doctors.index')}}" class="nav-link {{ session('lsbsm') == 'allDoctors' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Doctors</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('doctors.create')}}" class="nav-link {{ session('lsbsm') == 'createDoctors' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create Doctor</p>
                                </a>
                            </li>

                        </ul>
                    </li>



                    <li class="nav-item {{ session('lsbm') == 'visits'? ' menu-open ' : ''}}">
                    //     <a href="#" class="nav-link {{ session('lsbm') == 'visits'? ' active ' : ''}}">
                    //         <i class="nav-icon fas fa-user"></i>
                    //         <p>
                    //           Visit
                    //             <i class="fas fa-angle-left right"></i>
                    //         </p>
                    //     </a>
                    //     <ul class="nav nav-treeview">
                    //         <li class="nav-item">
                    //             <a href="{{route('visits.index')}}" class="nav-link {{ session('lsbsm') == 'allVisits' ? ' active ' : '' }}">
                    //                 <i class="far fa-circle nav-icon"></i>
                    //                 <p>All Visits</p>
                    //             </a>
                    //         </li>
                    //         <li class="nav-item">
                    //             <a href="{{route('visits.create')}}" class="nav-link {{ session('lsbsm') == 'createVisits' ? ' active ' : '' }}">
                    //                 <i class="far fa-circle nav-icon"></i>
                    //                 <p>Create Visit</p>
                    //             </a>
                    //         </li>

                    //     </ul>
                    </li>

                    <li class="nav-item {{ session('lsbm') == 'journal_posts'? ' menu-open ' : ''}}">
                        <a href="#" class="nav-link {{ session('lsbm') == 'journal_posts'? ' active ' : ''}}">
                            <i class="nav-icon far fa-share-square"></i>
                            <p>
                                Blog Post
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('blog-posts.index')}}" class="nav-link {{ session('lsbsm') == 'alljournalPosts' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Blog Posts</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('blog-posts.create')}}" class="nav-link {{ session('lsbsm') == 'storejournalPost' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create Blog Posts</p>
                                </a>
                            </li>

                        </ul>
                    </li>


         
                   <li class="nav-item {{ session('lsbm') == 'membershipM'? ' menu-open ' : ''}}">
                        <a href="#" class="nav-link {{ session('lsbm') == 'membershipM'? ' active ' : ''}}">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                               Agent Registration
                              <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('Showmembership')}}" class="nav-link {{ session('lsbsm') == 'membershipSM' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>New Agent Form</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('Allmembers')}}" class="nav-link {{ session('lsbsm') == 'allmembershipSM' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Agent Forms</p>
                                </a>
                            </li>

                        </ul>


                    </li>

                    
                   <li class="nav-item {{ session('lsbm') == 'member'? ' menu-open ' : ''}}">
                        <a href="#" class="nav-link {{ session('lsbm') == 'member'? ' active ' : ''}}">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                               Agent
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('allmember')}}" class="nav-link {{ session('lsbsm') == 'allMember' ? ' active ' : ''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Agents</p>
                                </a>
                            </li>

                        </ul>
                    </li>




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


                    <li class="nav-item {{ session('lsbm') == 'contact'? ' menu-open ' : ''}}">
                        <a href="#" class="nav-link {{ session('lsbm') == 'contact'? ' active ' : ''}}">
                            <i class="nav-icon fas fa-pager"></i>
                            <p>
                               Contact
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('all-contacts') }}" class="nav-link {{ session('lsbsm') == 'allContact'? ' active ' : ''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Contacts</p>
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
        <strong>Copyright &copy; 2023 <a href="https://adminlte.io/">{{env('APP_NAME')}}</a>.</strong>
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
@yield('script')
</body>

<!-- Mirrored from adminlte.io/themes/v3/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 19 Dec 2022 15:56:48 GMT -->
</html>















