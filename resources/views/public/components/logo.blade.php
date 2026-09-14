<section id="clients" class="clients section">
<div class="container" data-aos="fade-up">

    <div class="logo-marquee">

        <div class="logo-track">

            {{-- Logo Set 1 --}}
            <div class="faculty-logo">
                <img src="{{ asset('templates/frontend/assets/img/clients/client-1.png') }}"
                     alt="Logo Fakultas 1">
            </div>

            <div class="faculty-logo">
                <img src="{{ asset('templates/frontend/assets/img/clients/client-2.png') }}"
                     alt="Logo Fakultas 2">
            </div>

            <div class="faculty-logo">
                <img src="{{ asset('templates/frontend/assets/img/clients/client-3.png') }}"
                     alt="Logo Fakultas 3">
            </div>

            <div class="faculty-logo">
                <img src="{{ asset('templates/frontend/assets/img/clients/client-4.png') }}"
                     alt="Logo Fakultas 4">
            </div>

            <div class="faculty-logo">
                <img src="{{ asset('templates/frontend/assets/img/clients/client-5.png') }}"
                     alt="Logo Fakultas 5">
            </div>

            <div class="faculty-logo">
                <img src="{{ asset('templates/frontend/assets/img/clients/client-6.png') }}"
                     alt="Logo Fakultas 6">
            </div>


            {{-- Logo Set 2 --}}
            {{-- Duplikat untuk membuat animasi infinite tanpa putus --}}

            <div class="faculty-logo">
                <img src="{{ asset('templates/frontend/assets/img/clients/client-1.png') }}"
                     alt="Logo Fakultas 1">
            </div>

            <div class="faculty-logo">
                <img src="{{ asset('templates/frontend/assets/img/clients/client-2.png') }}"
                     alt="Logo Fakultas 2">
            </div>

            <div class="faculty-logo">
                <img src="{{ asset('templates/frontend/assets/img/clients/client-3.png') }}"
                     alt="Logo Fakultas 3">
            </div>

            <div class="faculty-logo">
                <img src="{{ asset('templates/frontend/assets/img/clients/client-4.png') }}"
                     alt="Logo Fakultas 4">
            </div>

            <div class="faculty-logo">
                <img src="{{ asset('templates/frontend/assets/img/clients/client-5.png') }}"
                     alt="Logo Fakultas 5">
            </div>

            <div class="faculty-logo">
                <img src="{{ asset('templates/frontend/assets/img/clients/client-6.png') }}"
                     alt="Logo Fakultas 6">
            </div>

        </div>

    </div>

</div>

</section> <style> /* ========================================= FACULTY LOGO MARQUEE ========================================= */ .logo-marquee { width: 100%; overflow: hidden; position: relative; padding: 30px 0; } /* Fade kiri dan kanan */ .logo-marquee::before, .logo-marquee::after { content: ""; position: absolute; top: 0; width: 160px; height: 100%; z-index: 5; pointer-events: none; } .logo-marquee::before { left: 0; background: linear-gradient( to right, var(--background-color), transparent ); } .logo-marquee::after { right: 0; background: linear-gradient( to left, var(--background-color), transparent ); } /* Track */ .logo-track { display: flex; align-items: center; width: max-content; animation: faculty-logo-scroll 30s linear infinite; } /* ========================================= LOGO ========================================= */ .faculty-logo { width: 250px; height: 180px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; padding: 20px 35px; } .faculty-logo img { width: 200px; height: 140px; object-fit: contain; display: block; transition: all 0.35s ease; filter: grayscale(10%); } /* Hover */ .faculty-logo:hover img { transform: scale(1.1); filter: grayscale(0%); } /* Pause ketika cursor diarahkan */ .logo-marquee:hover .logo-track { animation-play-state: paused; } /* ========================================= ANIMATION ========================================= */ @keyframes faculty-logo-scroll { from { transform: translateX(0); } to { transform: translateX(-50%); } } /* ========================================= TABLET ========================================= */ @media (max-width: 991px) { .faculty-logo { width: 210px; height: 160px; padding: 20px 25px; } .faculty-logo img { width: 170px; height: 120px; } .logo-track { animation-duration: 25s; } } /* ========================================= MOBILE ========================================= */ @media (max-width: 576px) { .logo-marquee { padding: 20px 0; } .faculty-logo { width: 180px; height: 140px; padding: 15px 20px; } .faculty-logo img { width: 150px; height: 110px; } .logo-track { animation-duration: 22s; } .logo-marquee::before, .logo-marquee::after { width: 80px; } } </style>
