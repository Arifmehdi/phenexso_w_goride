<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard | GoRide Bangladesh')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('goride/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    @stack('css')
</head>
<body>
    <header>
        <div class="nav-container">
            <div class="logo">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('goride/assets/go_ride_logo.jpg') }}" alt="GoRide Logo">
                </a>
            </div>
            <div class="nav-right">
                <span style="font-weight: 600; color: var(--text-color);">
                    @if(Auth::user()->role === 'corporate')
                        <i class="fas fa-building" style="margin-right: 8px; color: var(--primary-color);"></i>
                    @else
                        <i class="fas fa-user-circle" style="margin-right: 8px; color: var(--primary-color);"></i>
                    @endif
                    {{ Auth::user()->name }}
                </span>
                <a href="{{ route('logout') }}" class="lang-toggle">Logout</a>
            </div>
        </div>
    </header>

    <div class="dashboard-wrapper">
        <aside class="sidebar">
            <ul class="sidebar-menu">
                @include('goride.layouts.dashboard-sidebar')
            </ul>
        </aside>

        <main class="main-content">
            @yield('content')
        </main>
    </div>

    <script src="{{ asset('goride/js/main.js') }}"></script>
    @stack('js')
</body>
</html>
