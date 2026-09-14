  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="{{ route('home') }}" class="logo d-flex align-items-center me-auto">
        <img src="{{ asset('templates/frontend/assets/img/logo.png') }}" alt="">
        <h1 class="sitename">SIPAF</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
            <li>
                <a class="{{ request()->routeIs('home') ? 'active' : '' }}"
                href="{{ route('home') }}#beranda">
                    Beranda
                </a>
            </li>

            <li>
                <a class="{{ request()->routeIs('home') ? 'active' : '' }}"
                href="{{ route('home') }}#tentang-sipaf">
                    Tentang SIPAF
                </a>
            </li>

            <li>
                <a class="{{ request()->routeIs('pengaduan.create') ? 'active' : '' }}"
                href="{{ route('pengaduan.create') }}#buat-pengaduan">
                    Buat Pengaduan
                </a>
            </li>

            <li>
                <a class="{{ request()->routeIs('pengaduan.antrian') ? 'active' : '' }}"
                href="{{ route('pengaduan.antrian') }}#antrian-pengaduan">
                    Lihat Antrian Pengaduan
                </a>
            </li>

            <li>
                <a class="{{ request()->routeIs('home') ? 'active' : '' }}"
                href="{{ route('home') }}#kontak">
                    Kontak
                </a>
            </li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="{{ route('login') }}">Login</a>

    </div>
  </header>
