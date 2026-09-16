<footer>
    <div class="wrap">
        <div class="footer-grid">
            <div class="footer-brand">
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
                <p>
                    Kanal resmi Fakultas Teknik untuk menyampaikan pengaduan akademik secara transparan dan bertanggung jawab.
                </p>
            </div>
            <div class="footer-col">
                <h5>
                    Navigasi
                </h5>
                <ul>
                    <li>
                        <a href="#cara-kerja">
                            Cara Kerja
                        </a>
                    </li>
                    <li>
                        <a href="#kategori">
                            Jenis Pengaduan
                        </a>
                    </li>
                    <li>
                        <a href="#privasi">
                            Privasi &amp; Keamanan
                        </a>
                    </li>
                    <li>
                        <a href="#faq">
                            Pertanyaan Umum
                        </a>
                    </li>
                </ul>
            </div>
            <div class="footer-col">
                <h5>
                    Layanan
                </h5>
                <ul>
                    <li>
                        <a href="{{ route('pengaduan.create') }}">
                            Ajukan Pengaduan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pengaduan.antrian') }}">
                            Lacak Status
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('login') }}">
                            Masuk Akun
                        </a>
                    </li>
                </ul>
            </div>
            <div class="footer-col">
                <h5>
                    Kontak
                </h5>
                <ul>
                    <li>
                        <a href="mailto:pengaduan@ft.ac.id">
                            pengaduan@ft.ac.id
                        </a>
                    </li>
                    <li>
                        <a href="tel:+622112345678">
                            (021) 1234 5678
                        </a>
                    </li>
                    <li>
                        Gedung C, Ruang Fakultas Teknik, Lt. 1
                    </li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <span>
                © {{ date('Y') }} Fakultas Teknik. Seluruh hak dilindungi.
            </span>
            <span>
                Dikelola oleh Bagian Akademik &amp; Kemahasiswaan
            </span>
        </div>
    </div>
</footer>
