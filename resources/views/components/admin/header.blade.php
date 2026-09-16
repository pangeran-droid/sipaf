  <header class="pc-header">
    <div class="header-wrapper flex max-sm:px-[15px] px-[25px] grow">
      <!-- [Mobile Media Block] start -->
      <div class="me-auto pc-mob-drp">
        <ul class="inline-flex *:min-h-header-height *:inline-flex *:items-center">
          <!-- ======= Menu collapse Icon ===== -->
          <li class="pc-h-item pc-sidebar-collapse max-lg:hidden lg:inline-flex">
            <a href="#" class="pc-head-link ltr:!ml-0 rtl:!mr-0" id="sidebar-hide">
              <i class="ti ti-menu-2"></i>
            </a>
          </li>
          <li class="pc-h-item pc-sidebar-popup lg:hidden">
            <a href="#" class="pc-head-link ltr:!ml-0 rtl:!mr-0" id="mobile-collapse">
              <i class="ti ti-menu-2 text-2xl leading-none"></i>
            </a>
          </li>
          <li class="pc-h-item max-md:hidden md:inline-flex">
            <form class="form-search relative">
              <i class="search-icon absolute top-[14px] left-[15px]">
                <svg class="pc-icon w-4 h-4">
                  <use xlink:href="#custom-search-normal-1"></use>
                </svg>
              </i>
              <input type="search" class="form-control px-2.5 pr-3 pl-10 w-[198px] leading-none" placeholder="Ctrl + K" />
            </form>
          </li>
        </ul>
      </div>
      <!-- [Mobile Media Block end] -->
      <div class="ms-auto">
        <ul class="inline-flex *:min-h-header-height *:inline-flex *:items-center">
            <li class="dropdown pc-h-item">
                <a class="pc-head-link dropdown-toggle me-0" data-pc-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <svg class="pc-icon">
                    <use xlink:href="#custom-notification"></use>
                    </svg>
                    @if(isset($totalNotifikasi) && $totalNotifikasi > 0)
                    <span class="badge bg-success-500 text-white rounded-full z-10 absolute right-0 top-0">
                        {{ $totalNotifikasi }}
                    </span>
                    @endif
                </a>

                <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown p-2">
                    <div class="dropdown-header flex items-center justify-between py-4 px-5">
                        <h5 class="m-0">Notifications ({{ $totalNotifikasi ?? 0 }})</h5>
                        <a href="{{ route('admin.pengaduan.index') }}" class="btn btn-link btn-sm">Lihat Semua</a>
                    </div>

                    <div class="dropdown-body header-notification-scroll relative py-4 px-5" style="max-height: calc(100vh - 215px)">

                        @if(isset($notifikasiPengaduan) && $notifikasiPengaduan->isNotEmpty())
                            <p class="text-span mb-3">Pengaduan Baru Masuk</p>

                            @foreach($notifikasiPengaduan as $notif)
                                <div class="card mb-2 hover:bg-gray-50 transition-all">
                                    <div class="card-body">
                                        <div class="flex gap-4">
                                        <div class="shrink-0">
                                            <svg class="pc-icon text-primary-500 w-[22px] h-[22px]">
                                                <use xlink:href="#custom-document-text"></use>
                                            </svg>
                                        </div>
                                        <div class="grow">
                                            <span class="float-end text-sm text-muted">{{ $notif->created_at->diffForHumans() }}</span>
                                            <h5 class="text-body mb-2">
                                                {{ $notif->jurusan->nama_jurusan ?? 'Umum' }}
                                                <span class="text-xs bg-warning-500/10 text-warning-500 px-2 py-0.5 rounded-full ml-1">Baru</span>
                                            </h5>
                                            <p class="mb-2 text-sm text-gray-600">
                                                {{ Str::limit($notif->isi_pengaduan ?? $notif->deskripsi, 80, '...') }}
                                            </p>
                                            <a href="{{ route('admin.pengaduan.index') }}" class="btn btn-sm btn-light-primary py-1 px-3 inline-block rounded text-xs">
                                                Periksa
                                            </a>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-4 text-muted">
                                <p class="mb-0">Tidak ada pengaduan baru masuk.</p>
                            </div>
                        @endif

                    </div>

                    <div class="text-center py-2 border-t border-gray-100 mt-2">
                        <a href="{{ route('admin.pengaduan.index') }}" class="text-primary-500 hover:text-primary-600 font-medium text-sm">
                            Buka Semua Daftar Pengaduan
                        </a>
                    </div>
                </div>
            </li>
          <li class="dropdown pc-h-item header-user-profile">
            <a class="pc-head-link dropdown-toggle arrow-none me-0" data-pc-toggle="dropdown" href="#" role="button" aria-haspopup="false" data-pc-auto-close="outside" aria-expanded="false">
              <img src="{{ asset('templates/backend/images/user/avatar-2.jpg') }}" alt="user-image" class="user-avtar w-10 h-10 rounded-full" />
            </a>
            <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown p-2">
              <div class="dropdown-header flex items-center justify-between py-4 px-5">
                <h5 class="m-0">Profile</h5>
              </div>
              <div class="profile-notification-scroll position-relative" style="max-height: calc(100vh - 225px)">
                <div class="dropdown-body py-4 px-5">
                  <div class="flex mb-1 items-center">
                    <div class="shrink-0">
                      <img src="{{ asset('templates/backend/images/user/avatar-2.jpg') }}" alt="user-image" class="w-10 rounded-full" />
                    </div>
                    <div class="grow ms-3">
                      <h6 class="mb-1">Carson Darrin 🖖</h6>
                      <span>carson.darrin@company.io</span>
                    </div>
                  </div>
                  <hr class="border-secondary-500/10 my-4" />
                  <div class="card">
                    <div class="card-body !py-4">
                      <div class="flex items-center justify-between">
                        <h5 class="mb-0 inline-flex items-center">
                          <svg class="pc-icon text-muted me-2 w-[22px] h-[22px]">
                            <use xlink:href="#custom-notification-outline"></use>
                          </svg>
                          Notification
                        </h5>
                        <label class="inline-flex items-center cursor-pointer">
                          <input type="checkbox" value="" class="sr-only peer" />
                          <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                        </label>
                      </div>
                    </div>
                  </div>
                  <p class="text-span mb-3">Manage</p>
                  <a href="#" class="dropdown-item">
                    <span>
                      <svg class="pc-icon text-muted me-2 inline-block">
                        <use xlink:href="#custom-lock-outline"></use>
                      </svg>
                      <span>Change Password</span>
                    </span>
                  </a>
                  <hr class="border-secondary-500/10 my-4" />
                  <p class="text-span mb-3">Team</p>
                  <a href="#" class="dropdown-item">
                    <span>
                      <svg class="pc-icon text-muted me-2 inline-block">
                        <use xlink:href="#custom-profile-2user-outline"></use>
                      </svg>
                      <span>UI Design team</span>
                    </span>
                    <div dir="ltr" class="flex -space-x-2 overflow-hidden *:flex *:items-center *:justify-center *:rounded-full *:w-[30px] *:h-[30px] *:hover:z-10 *:border *:border-2 *:border-white">
                      <img src="{{ asset('templates/backend/images/user/avatar-1.jpg') }}" alt="user-image" class="avtar" />
                      <span class="avtar bg-danger-500 text-white">K</span>
                      <span class="avtar bg-success-500 text-white">
                        <svg class="pc-icon m-0">
                          <use xlink:href="#custom-user"></use>
                        </svg>
                      </span>
                      <span class="avtar bg-theme-cardbg dark:bg-themedark-cardbg overflow-hidden">
                        <span class="flex items-center justify-center w-full h-full bg-primary-500/10 text-primary-500">+2</span>
                      </span>
                    </div>
                  </a>
                  <a href="#" class="dropdown-item">
                    <span>
                      <svg class="pc-icon text-muted me-2 inline-block">
                        <use xlink:href="#custom-add-outline"></use>
                      </svg>
                      <span>Add new</span>
                    </span>
                    <div dir="ltr" class="flex -space-x-2 overflow-hidden *:flex *:items-center *:justify-center *:rounded-full *:w-[30px] *:h-[30px] *:hover:z-10 *:border-2 *:border-white">
                      <span class="avtar bg-primary-500 text-white">
                        <svg class="pc-icon m-0">
                          <use xlink:href="#custom-add-outline"></use>
                        </svg>
                      </span>
                    </div>
                  </a>
                  <hr class="border-secondary-500/10 my-4" />
                  <div class="grid mb-3">
                    <form action="{{ route('logout') }}" method="POST" id="logout-form-grid" class="hidden">
                        @csrf
                    </form>
                    <a href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form-grid').submit();"
                        class="btn btn-primary-500 flex items-center justify-center">
                        <svg class="pc-icon me-2 w-[22px] h-[22px]">
                            <use xlink:href="#custom-logout-1-outline"></use>
                        </svg>
                        Logout
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </header>
