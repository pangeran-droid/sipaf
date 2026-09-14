@extends('layouts.public', ['title' => 'Beranda - SIPAF'])

@section('content')
<div class="p-5 mb-4 bg-white rounded-3 shadow-sm border">
    <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold text-primary">Layanan Pengaduan Akademik Fakultas</h1>
        <p class="col-md-8 fs-4 text-secondary mt-3">
            Sampaikan pengaduan, kendala perkuliahan, atau layanan akademik Anda secara transparan, cepat, dan langsung ditangani oleh jurusan terkait.
        </p>
        <div class="mt-4">
            <a href="{{ route('pengaduan.create') }}" class="btn btn-primary btn-lg me-2">
                <i class="bi bi-pencil-square me-2"></i>Buat Pengaduan Sekarang
            </a>
            <a href="{{ route('pengaduan.antrian') }}" class="btn btn-outline-secondary btn-lg">
                <i class="bi bi-kanban me-2"></i>Lihat Antrian Pengaduan
            </a>
        </div>
    </div>
</div>

<div class="row text-center g-4 my-4">
    <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm p-3">
            <div class="card-body">
                <div class="text-primary fs-1 mb-3"><i class="bi bi-shield-lock-fill"></i></div>
                <h5 class="card-title fw-bold">Aman & Terarah</h5>
                <p class="card-text text-muted">Pengaduan Anda otomatis diarahkan ke admin jurusan masing-masing dengan menjaga privasi identitas pelapor dari publik.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm p-3">
            <div class="card-body">
                <div class="text-primary fs-1 mb-3"><i class="bi bi-stopwatch-fill"></i></div>
                <h5 class="card-title fw-bold">Real-Time Tracking</h5>
                <p class="card-text text-muted">Pantau status penanganan pengaduan secara real-time melalui halaman antrian publik dengan kode unik pengaduan.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm p-3">
            <div class="card-body">
                <div class="text-primary fs-1 mb-3"><i class="bi bi-journal-check"></i></div>
                <h5 class="card-title fw-bold">Transparan</h5>
                <p class="card-text text-muted">Setiap tahapan penanganan dari proses hingga selesai tercatat secara historis dan akurat oleh pengelola fakultas.</p>
            </div>
        </div>
    </div>
</div>
@endsection