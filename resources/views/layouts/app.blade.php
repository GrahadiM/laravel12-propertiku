<!Doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Hadoy Dev">
    <meta name="description" content="Cari rumah, apartemen, dan ruko impian Anda di Studio Naadi.">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Studio Naadi - Hunian Impian Anda') }}</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />

    <link rel="stylesheet" href="{{ asset('frontend/assets/libraries/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}" />

    @stack('style-alt')
</head>
<body>

    @include('partials.header')

    @yield('content')

    @include('partials.footer')

    <script src="{{ asset('frontend/assets/libraries/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>
    @stack('script-alt')
</body>
</html>
