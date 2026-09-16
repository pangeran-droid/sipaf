<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="preset-1" data-pc-sidebar-caption="true" data-pc-layout="vertical" data-pc-direction="ltr" dir="ltr" data-pc-theme_contrast="" data-pc-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title . ' - ' : '' }}{{ config('app.name') }}</title>
    <link rel="icon" href="{{ asset('templates/backend/images/favicon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('templates/backend/fonts/inter/inter.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/backend/fonts/phosphor/duotone/style.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/backend/fonts/tabler-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/backend/fonts/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/backend/fonts/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/backend/fonts/material.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/backend/css/style.css') }}">

    @stack('styles')

</head>

<body>

    <!-- Loader -->
    <div class="loader-bg fixed inset-0 bg-white dark:bg-themedark-cardbg z-[1034]">
        <div class="loader-track h-[5px] w-full inline-block absolute overflow-hidden top-0 bg-primary-500/40">
            <div class="loader-fill w-[300px] h-[5px] bg-primary-500 absolute top-0 left-0"></div>
        </div>
    </div>

    <!-- Sidebar -->
    @include('components.admin.sidebar')

    <!-- Header -->
    @include('components.admin.header')

    <!-- Content -->
    <div class="pc-container">
        <div class="pc-content">

            @yield('content')

        </div>
    </div>

    <!-- Footer -->
    @include('components.admin.footer')


    <!-- Global JS -->
    <script src="{{ asset('templates/backend/js/plugins/simplebar.min.js') }}"></script>
    <script src="{{ asset('templates/backend/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('templates/backend/js/icon/custom-font.js') }}"></script>
    <script src="{{ asset('templates/backend/js/plugins/feather.min.js') }}"></script>
    <script src="{{ asset('templates/backend/js/component.js') }}"></script>
    <script src="{{ asset('templates/backend/js/theme.js') }}"></script>
    <script src="{{ asset('templates/backend/js/script.js') }}"></script>

    <script>
        layout_change('false');
        layout_theme_contrast_change('false');
        change_box_container('false');
        layout_caption_change('true');
        layout_rtl_change('false');
        preset_change('preset-1');
        main_layout_change('vertical');
    </script>

    @stack('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const toggle = document.getElementById('notificationToggle');
            const content = document.getElementById('notificationContent');
            const badge = document.getElementById('notificationBadge');

            if (!toggle) {
                return;
            }

            const savedStatus = localStorage.getItem('notification_enabled');

            if (savedStatus === null) {
                toggle.checked = true;
            } else {
                toggle.checked = savedStatus === 'true';
            }

            updateNotification();

            toggle.addEventListener('change', function () {

                localStorage.setItem(
                    'notification_enabled',
                    this.checked ? 'true' : 'false'
                );

                updateNotification();
            });

            function updateNotification() {

                if (toggle.checked) {

                    if (content) {
                        content.style.display = '';
                    }

                    if (badge) {
                        badge.style.display = '';
                    }

                } else {

                    if (content) {
                        content.style.display = 'none';
                    }

                    if (badge) {
                        badge.style.display = 'none';
                    }
                }
            }

        });
    </script>

</body>
</html>
