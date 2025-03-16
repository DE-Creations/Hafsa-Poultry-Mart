<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

    <meta name="description" content="Marketplace for Bootstrap Admin Dashboards" />
    <meta name="author" content="Bootstrap Gallery" />
    <link rel="canonical" href="https://www.bootstrap.gallery/">
    {{--  <meta property="og:url" content="https://www.bootstrap.gallery">
    <meta property="og:title" content="Admin Templates - Dashboard Templates | Bootstrap Gallery">
    <meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:type" content="Website">
    <meta property="og:site_name" content="Bootstrap Gallery">  --}}
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" />

    <!-- Icomoon Font Icons css -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/icomoon/style.css') }}" />

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.min.css') }}" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="login-bg">
    <!-- Container start -->
    <div class="container p-0">
        <!-- Row start -->
        <div class="row g-0">
            <div class="col-xl-6 col-lg-12"></div>
            <div class="col-xl-6 col-lg-12">
                <!-- Row start -->
                <div class="row align-items-center justify-content-center">
                    <div class="col-xl-8 col-sm-4 col-12">
                        {{ $slot }}
                    </div>
                </div>
                <!-- Row end -->
            </div>
        </div>
        <!-- Row end -->
    </div>
    <!-- Container end -->
</body>

</html>
