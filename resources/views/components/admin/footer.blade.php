<footer class="pc-footer">
    <div class="footer-wrapper container-fluid mx-10">
        <div class="grid grid-cols-12 gap-1.5">
            <div class="col-span-12 sm:col-span-6 my-1">
                <p class="m-0">
                    © {{ date('Y') }}
                    <span>SIPAF - Sistem Informasi Pengaduan Akademik Fakultas</span>
                </p>
            </div>
            <div class="col-span-12 sm:col-span-6 my-1">
                <ul class="mb-0 ltr:sm:text-right rtl:sm:text-left">
                    <li class="inline-block sm:ml-2">
                        <a href="{{ route('admin.dashboard') }}">
                            Home
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
