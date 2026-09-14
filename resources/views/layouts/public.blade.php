<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Sistem Informasi Pengaduan Akademik Fakultas' }}</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        main {
            flex: 1;
        }
        .kanban-col {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.05);
            padding: 20px;
            height: 100%;
            transition: transform 0.2s ease;
        }
        .navbar-brand {
            letter-spacing: 0.5px;
        }
        .card {
            border-radius: 10px;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                <i class="bi bi-megaphone-fill me-2"></i>SIPAF Fakultas
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item">
                        <a class="nav-link px-3 {{ request()->routeIs('home') ? 'active fw-bold' : '' }}" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 {{ request()->routeIs('pengaduan.create') ? 'active fw-bold' : '' }}" href="{{ route('pengaduan.create') }}">Buat Pengaduan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 {{ request()->routeIs('pengaduan.antrian') ? 'active fw-bold' : '' }}" href="{{ route('pengaduan.antrian') }}">Antrian Pengaduan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 {{ request()->routeIs('tentang') ? 'active fw-bold' : '' }}" href="{{ route('tentang') }}">Tentang Sistem</a>
                    </li>
                    <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                        @auth
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-light btn-sm text-primary fw-bold px-3 py-2 shadow-sm">Dashboard Admin</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm px-3 py-2">Login Admin</a>
                        @endauth
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-5">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4 mt-auto shadow-sm">
        <div class="container">
            <p class="mb-0 text-white-50 small">&copy; {{ date('Y') }} Sistem Informasi Pengaduan Akademik Fakultas. Hak Cipta Dilindungi.</p>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>