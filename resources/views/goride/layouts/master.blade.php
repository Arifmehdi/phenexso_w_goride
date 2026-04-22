<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GoRide Bangladesh | Car Rental & Transport Marketplace')</title>
    <meta name="description" content="@yield('meta_description', 'Bangladesh\'s leading car rental and transport marketplace. Book rides, explore tours, and manage corporate transport nationwide.')">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('goride/css/style.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">
    @stack('css')
</head>
<body>

@include('goride.layouts.header')

@yield('content')

@include('goride.layouts.footer')


<a href="https://wa.me/88{{ $ws->contact_mobile }}" class="whatsapp-float" target="_blank" rel="noopener" aria-label="WhatsApp">
    <i class="fab fa-whatsapp"></i>
</a>

<script src="{{ asset('goride/js/main.js') }}"></script>
@stack('js')
</body>
</html>
