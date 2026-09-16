@extends('layouts.public')

@section('description', 'Kanal resmi Fakultas untuk menyampaikan pengaduan akademik secara transparan, terlacak, dan rahasia.')

@section('content')

    @include('public.components.sections.hero')

    @include('public.components.sections.fakultas')

    @include('public.components.sections.stats')

    @include('public.components.sections.cara-kerja')

    @include('public.components.sections.kategori')

    @include('public.components.sections.privasi')

    @include('public.components.sections.faq')

    @include('public.components.sections.cta')

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const navToggle = document.getElementById('navToggle');
        const siteNav = document.getElementById('siteNav');

        if (navToggle && siteNav) {
            navToggle.addEventListener('click', function () {
                siteNav.classList.toggle('is-open');
                navToggle.classList.toggle('is-active');
            });

            siteNav.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', () => {
                    siteNav.classList.remove('is-open');
                    navToggle.classList.remove('is-active');
                });
            });
        }
    });
</script>
