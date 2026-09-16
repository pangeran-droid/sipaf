<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            @yield('title', 'SIPAF — Sistem Informasi Pengaduan Akademik Fakultas')
        </title>
        <meta name="description" content="@yield('description', 'Kanal resmi Fakultas untuk menyampaikan pengaduan akademik secara transparan, terlacak, dan rahasia.')">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta property="og:type" content="@yield('og_type', 'website')">
        <meta property="og:title" content="@yield('og_title', 'SIGAP — Sistem Informasi Pengaduan Akademik Fakultas')">
        <meta property="og:description" content="@yield('og_description', 'Kanal resmi Fakultas untuk menyampaikan pengaduan akademik secara transparan, terlacak, dan rahasia.')">
        <meta property="og:image" content="@yield('og_image', asset('images/og-image.jpg'))">
        <meta property="og:locale" content="id_ID">
        <!-- Favicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css" integrity="sha512-QeR2VH+lsBE5LSAe1Q5EnTBbe7XTBubt8dG93Y7gidSgdMCr8nVqKcfKAMyN96SV8KDbZVTDXChatu5G2KQGzg==" crossorigin="anonymous" referrerpolicy="no-referrer">
        <link href="{{ asset('/templates/frontend/assets/img/favicon.png') }}" rel="icon" type="image/png">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600&family=IBM+Plex+Sans:wght@400;500;600&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
        <!-- Css -->
        <link href="{{ asset('templates/frontend/assets/css/style.css') }}" rel="stylesheet">

        @yield('styles')

    </head>
    <body>

        @include('public.components.header')

            @yield('content')

        @include('public.components.footer')

        @yield('scripts')

    </body>
</html>
