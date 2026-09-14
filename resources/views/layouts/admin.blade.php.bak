<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Panel - SIPAF' }}</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 56px 0 0;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
            background-color: #212529;
        }
        @media (max-width: 767.98px) {
            .sidebar {
                position: static;
                padding-top: 0;
            }
        }
        .sidebar .nav-link {
            font-weight: 500;
            color: #adb5bd;
            padding: 12px 20px;
            transition: all 0.2s ease;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.1);
        }
        .sidebar .nav-link i {
            margin-right: 10px;
        }
        .main-content {
            margin-left: 240px;
        }
        @media (max-width: 767.98px) {
            .main-content {
                margin-left: 0;
            }
        }
        .card {
            border-radius: 10px;
        }
        @media print {
            .sidebar, .navbar, .btn, form {
                display: none !important;
            }
            .main-content {
                margin-left: 0 !important;
                padding-top: 0 !important;
            }
        }
    </style>
</head>
<body>

    <!-- Top Navbar -->
    <nav class="navbar navbar-dark bg-primary fixed-top shadow-sm px-3">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-shield-lock-fill me-2"></i>SIPAF Admin Panel
            </a>
            <div class="dropdown">
                <a href="#" class="text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle me-1"></i> {{ auth()->user()->name }} 
                    <span class="badge bg-light text-primary ms-1">{{ auth()->user()->role === 'super_admin' ? 'Super Admin' : auth()->user()->jurusan->nama_jurusan }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger py-2"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-speedometer2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.pengaduan.*') ? 'active' : '' }}" href="{{ route('admin.pengaduan.index') }}">
                                <i class="bi bi-chat-square-text"></i> Pengaduan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}" href="{{ route('admin.laporan.index') }}">
                                <i class="bi bi-file-earmark-bar-graph"></i> Laporan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}" target="_blank">
                                <i class="bi bi-globe"></i> Lihat Frontend
                            </a>
                        </li>
                        
                        @if(auth()->user()->role === 'super_admin')
                            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase fs-7">
                                <span>Manajemen Fakultas</span>
                            </h6>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.jurusan.*') ? 'active' : '' }}" href="{{ route('admin.jurusan.index') }}">
                                    <i class="bi bi-building"></i> Jurusan
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.manajemen-admin.*') ? 'active' : '' }}" href="{{ route('admin.manajemen-admin.index') }}">
                                    <i class="bi bi-people"></i> Admin
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </nav>

            <!-- Main Content Area -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content pt-5 mt-4">
                <div class="py-4">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>