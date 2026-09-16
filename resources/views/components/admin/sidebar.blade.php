  <nav class="pc-sidebar">
    <div class="navbar-wrapper">
      <div class="m-header flex items-center py-4 px-6 h-header-height">
        <a href="{{ route('admin.dashboard') }}" class="b-brand flex items-center gap-3">
          <!-- ========   Change your logo from here   ============ -->
          <img src="{{ asset('templates/backend/images/logo-dark.svg') }}" class="img-fluid logo-lg" alt="logo" />
          <span class="badge bg-success-500/10 text-success-500 rounded-full theme-version">v1.0.0</span>
        </a>
      </div>
      <div class="navbar-content h-[calc(100vh_-_74px)] py-2.5">
        <div class="card pc-user-card mx-[15px] mb-[15px] bg-theme-sidebaruserbg dark:bg-themedark-sidebaruserbg">
          <div class="card-body !p-5">
            <div class="flex items-center">
              <img class="shrink-0 w-[45px] h-[45px] rounded-full" src="{{ asset('templates/backend/images/user/avatar-1.jpg') }}" alt="user-image" />
              <div class="ml-4 mr-2 grow">
                <h6 class="mb-0" data-i18n="Jonh Smith">{{ auth()->user()->name }}</h6>
                <small data-i18n="Administrator">{{ auth()->user()->role ?? 'Administrator' }}</small>
              </div>
              <a class="shrink-0 btn btn-icon inline-flex btn-link-secondary" data-pc-toggle="collapse" href="#pc_sidebar_userlink">
                <svg class="pc-icon w-[22px] h-[22px]">
                  <use xlink:href="#custom-sort-outline"></use>
                </svg>
              </a>
            </div>
            <div class="hidden pc-user-links" id="pc_sidebar_userlink">
              <div class="pt-3 *:flex *:items-center *:py-2 *:gap-2.5 *:hover:text-primary-500">
                <a href="#">
                  <i class="text-lg leading-none ti ti-user"></i>
                  <span data-i18n="My Account">My Account</span>
                </a>
                <form action="{{ route('logout') }}" method="POST" id="logout-form" class="hidden">
                    @csrf
                </form>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="text-lg leading-none ti ti-power"></i>
                    <span>{{ __('Log Out') }}</span>
                </a>
              </div>
            </div>
          </div>
        </div>
        <ul class="pc-navbar">
          <li class="pc-item pc-caption">
            <label>Utama</label>
          </li>
          <li class="pc-item">
            <a href="{{ route('admin.dashboard') }}" class="pc-link">
              <span class="pc-micon">
                <svg class="pc-icon">
                  <use xlink:href="#custom-status-up"></use>
                </svg>
              </span>
              <span class="pc-mtext">Dashboard</span>
            </a>
          </li>
          <li class="pc-item">
            <a href="{{ route('admin.pengaduan.index') }}" class="pc-link"><span class="pc-micon">
                <svg class="pc-icon">
                  <use xlink:href="#custom-notification-status"></use>
                </svg> </span><span class="pc-mtext">Daftar Pengaduan</span></a>
          </li>
          <li class="pc-item pc-caption">
            <label>Asisten</label>
          </li>
          <li class="pc-item">
            <a href="{{ route('admin.ai-asisten.index') }}" class="pc-link">
              <span class="pc-micon">
                <svg class="pc-icon">
                  <use xlink:href="#custom-mouse-circle"></use>
                </svg>
              </span>
              <span class="pc-mtext">Ai Asisten</span>
              <span class="badge bg-success-500/10 text-success-500 rounded-full theme-version">new</span>
            </a>
          </li>
          <li class="pc-item pc-caption">
            <label>Manajemen</label>
          </li>
          <li class="pc-item">
            <a href="{{ route('admin.laporan.index') }}" class="pc-link"><span class="pc-micon">
                <svg class="pc-icon">
                  <use xlink:href="#custom-document-filter"></use>
                </svg> </span><span class="pc-mtext">Laporan Pengaduan</span></a>
          </li>
          @if(auth()->user()->role === 'super_admin')
            <li class="pc-item">
                <a href="{{ route('admin.jurusan.index') }}" class="pc-link"><span class="pc-micon">
                    <svg class="pc-icon">
                    <use xlink:href="#custom-layer"></use>
                    </svg> </span><span class="pc-mtext">Jurusan</span></a>
            </li>
            <li class="pc-item">
                <a href="{{ route('admin.manajemen-admin.index') }}" class="pc-link"><span class="pc-micon">
                    <svg class="pc-icon">
                    <use xlink:href="#custom-user"></use>
                    </svg> </span><span class="pc-mtext">Admin</span></a>
            </li>
          @endif

          {{-- <li class="pc-item pc-caption">
            <label>Other</label>
            <svg class="pc-icon">
              <use xlink:href="#custom-notification-status"></use>
            </svg>
          </li>
          <li class="pc-item pc-hasmenu">
            <a href="#!" class="pc-link"><span class="pc-micon">
                <svg class="pc-icon">
                  <use xlink:href="#custom-level"></use>
                </svg> </span><span class="pc-mtext">Menu levels</span><span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
            <ul class="pc-submenu">
              <li class="pc-item"><a class="pc-link" href="#!">Level 2.1</a></li>
              <li class="pc-item pc-hasmenu">
                <a href="#!" class="pc-link">Level 2.2<span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
                <ul class="pc-submenu">
                  <li class="pc-item"><a class="pc-link" href="#!">Level 3.1</a></li>
                  <li class="pc-item"><a class="pc-link" href="#!">Level 3.2</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li class="pc-item">
            <a href="../other/sample-page.html" class="pc-link">
              <span class="pc-micon">
                <svg class="pc-icon">
                  <use xlink:href="#custom-notification-status"></use>
                </svg>
              </span>
              <span class="pc-mtext">Sample page</span>
            </a>
          </li> --}}
        </ul>
      </div>
    </div>
  </nav>
