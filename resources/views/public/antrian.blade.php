@extends('layouts.public', ['title' => 'Antrian Pengaduan - SIPAF'])

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h2 class="fw-bold mb-3"><i class="bi bi-kanban me-2"></i>Antrian Pengaduan Publik</h2>
        <p class="text-muted">Daftar pengaduan akademik yang masuk ke fakultas beserta status penanganannya secara transparan.</p>
        
        <!-- Filter Form -->
        <form method="GET" action="{{ route('pengaduan.antrian') }}" class="row g-3 bg-white p-3 rounded shadow-sm border">
            <div class="col-md-5">
                <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Cari Kode Pengaduan (cth: ADU-20260913-0001)">
            </div>
            <div class="col-md-5">
                <select name="jurusan_id" class="form-select">
                    <option value="">-- Semua Jurusan --</option>
                    @foreach($jurusans as $jurusan)
                        <option value="{{ $jurusan->id }}" {{ request('jurusan_id') == $jurusan->id ? 'selected' : '' }}>
                            {{ $jurusan->nama_jurusan }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 d-grid">
                <button type="submit" class="btn btn-primary"><i class="bi bi-search me-1"></i>Filter</button>
            </div>
        </form>
    </div>
</div>

<!-- Kanban Columns -->
<div class="row g-4">
    <!-- Kolom Proses -->
    <div class="col-lg-4">
        <div class="kanban-col border-top border-primary border-4">
            <h5 class="fw-bold text-primary mb-3"><i class="bi bi-hourglass-split me-2"></i>Proses</h5>
            <hr>
            @forelse($proses as $item)
                <div class="card mb-3 shadow-sm border">
                    <div class="card-body">
                        <span class="badge bg-primary mb-2">{{ $item->kode_pengaduan }}</span>
                        <h6 class="fw-bold text-dark mb-1">{{ $item->jurusan->nama_jurusan }}</h6>
                        <p class="small text-muted mb-2"><i class="bi bi-person-badge me-1"></i>Dosen: {{ $item->nama_dosen }}</p>
                        <div class="text-end text-muted small"><i class="bi bi-calendar-event me-1"></i>{{ $item->created_at->format('d M Y') }}</div>
                    </div>
                </div>
            @empty
                <p class="text-muted small text-center py-3">Tidak ada pengaduan dalam status proses.</p>
            @endforelse
            <div class="mt-3">
                {{ $proses->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

    <!-- Kolom Sedang Ditangani -->
    <div class="col-lg-4">
        <div class="kanban-col border-top border-warning border-4">
            <h5 class="fw-bold text-warning mb-3 text-dark"><i class="bi bi-gear-fill me-2 text-warning"></i>Sedang Ditangani</h5>
            <hr>
            @forelse($sedangDitangani as $item)
                <div class="card mb-3 shadow-sm border">
                    <div class="card-body">
                        <span class="badge bg-warning text-dark mb-2">{{ $item->kode_pengaduan }}</span>
                        <h6 class="fw-bold text-dark mb-1">{{ $item->jurusan->nama_jurusan }}</h6>
                        <p class="small text-muted mb-2"><i class="bi bi-person-badge me-1"></i>Dosen: {{ $item->nama_dosen }}</p>
                        <div class="text-end text-muted small"><i class="bi bi-calendar-event me-1"></i>{{ $item->created_at->format('d M Y') }}</div>
                    </div>
                </div>
            @empty
                <p class="text-muted small text-center py-3">Tidak ada pengaduan sedang ditangani.</p>
            @endforelse
            <div class="mt-3">
                {{ $sedangDitangani->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

    <!-- Kolom Selesai -->
    <div class="col-lg-4">
        <div class="kanban-col border-top border-success border-4">
            <h5 class="fw-bold text-success mb-3"><i class="bi bi-check-circle-fill me-2"></i>Selesai</h5>
            <hr>
            @forelse($selesai as $item)
                <div class="card mb-3 shadow-sm border">
                    <div class="card-body">
                        <span class="badge bg-success mb-2">{{ $item->kode_pengaduan }}</span>
                        <h6 class="fw-bold text-dark mb-1">{{ $item->jurusan->nama_jurusan }}</h6>
                        <p class="small text-muted mb-2"><i class="bi bi-person-badge me-1"></i>Dosen: {{ $item->nama_dosen }}</p>
                        <div class="text-end text-muted small"><i class="bi bi-calendar-event me-1"></i>{{ $item->created_at->format('d M Y') }}</div>
                    </div>
                </div>
            @empty
                <p class="text-muted small text-center py-3">Tidak ada pengaduan selesai.</p>
            @endforelse
            <div class="mt-3">
                {{ $selesai->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection