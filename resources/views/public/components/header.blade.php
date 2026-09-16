<header class="site-header">
    <div class="wrap header-row">
        <a href="{{ route('home') }}" class="brand">
            <span class="brand-mark">
                FT
            </span>
            <span class="brand-text">
                <strong>
                    SIPAF
                </strong>
                <span>
                    Pengaduan Akademik Fakultas Teknik
                </span>
            </span>
        </a>

        <nav class="site-nav" id="siteNav">
            <ul class="nav-links">
                <li>
                    <a href="{{ route('home') }}#cara-kerja">
                        Cara Kerja
                    </a>
                </li>
                <li>
                    <a href="{{ route('home') }}#kategori">
                        Jenis Pengaduan
                    </a>
                </li>
                <li>
                    <a href="{{ route('home') }}#privasi">
                        Privasi &amp; Keamanan
                    </a>
                </li>
                <li>
                    <a href="{{ route('home') }}#faq">
                        Pertanyaan Umum
                    </a>
                </li>
            </ul>

            <div class="mobile-menu-actions">
                <a href="{{ route('login') }}" class="btn btn-ghost" style="width: 100%; text-align: center;">
                    Masuk
                </a>
                <a href="{{ route('pengaduan.create') }}" class="btn btn-primary" style="width: 100%; text-align: center;">
                    Ajukan Pengaduan
                </a>
            </div>
        </nav>

        <div class="header-actions">
            <a href="{{ route('login') }}" class="btn btn-ghost btn-desktop-only">
                Masuk
            </a>
            <a href="{{ route('pengaduan.create') }}" class="btn btn-primary btn-desktop-only">
                Ajukan Pengaduan
            </a>

            <button type="button" class="nav-toggle" id="navToggle" aria-label="Toggle Menu">
                <span class="hamburger-bar"></span>
                <span class="hamburger-bar"></span>
                <span class="hamburger-bar"></span>
            </button>
        </div>
    </div>
</header>
