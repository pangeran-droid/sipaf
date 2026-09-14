@extends('layouts.admin', ['title' => 'Kelola Pengaduan - SIPAF Admin'])

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2 fw-bold">Daftar Pengaduan Akademik</h1>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Filter Form -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.pengaduan.index') }}" class="row g-3">
            <div class="col-md-3">
                <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Cari Kode / Nama Pengadu">
            </div>
            
            @if(auth()->user()->role === 'super_admin')
                <div class="col-md-3">
                    <select name="jurusan_id" class="form-select">
                        <option value="">-- Semua Jurusan --</option>
                        @foreach($jurusans as $jurusan)
                            <option value="{{ $jurusan->id }}" {{ request('jurusan_id') == $jurusan->id ? 'selected' : '' }}>
                                {{ $jurusan->nama_jurusan }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif

            <div class="col-md-2">
                <select name="status" class="form-select">
                    <option value="">-- Semua Status --</option>
                    <option value="Proses" {{ request('status') == 'Proses' ? 'selected' : '' }}>Proses</option>
                    <option value="Sedang Ditangani" {{ request('status') == 'Sedang Ditangani' ? 'selected' : '' }}>Sedang Ditangani</option>
                    <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-filter me-1"></i>Filter</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('admin.pengaduan.index') }}" class="btn btn-outline-secondary w-100">Reset</a>
            </div>
        </form>
    </div>
</div>

<!-- Tabel Pengaduan -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="py-3 ps-3">Kode</th>
                        <th class="py-3">Nama Pengadu</th>
                        <th class="py-3">Jurusan</th>
                        <th class="py-3">Dosen Terkait</th>
                        <th class="py-3">Status</th>
                        <th class="py-3">Tanggal</th>
                        <th class="py-3 text-end pe-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengaduans as $item)
                        <tr>
                            <td class="ps-3 fw-bold text-primary">{{ $item->kode_pengaduan }}</td>
                            <td>{{ $item->nama_pengadu }}</td>
                            <td>{{ $item->jurusan->nama_jurusan }}</td>
                            <td>{{ $item->nama_dosen }}</td>
                            <td>
                                @if($item->status === 'Proses')
                                    <span class="badge bg-info text-dark">Proses</span>
                                @elseif($item->status === 'Sedang Ditangani')
                                    <span class="badge bg-warning text-dark">Sedang Ditangani</span>
                                @else
                                    <span class="badge bg-success">Selesai</span>
                                @endif
                            </td>
                            <td class="text-muted small">{{ $item->created_at->format('d M Y, H:i') }}</td>
                            <td class="text-end pe-3">
                                <a href="{{ route('admin.pengaduan.show', $item->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">Tidak ada data pengaduan ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white py-3">
        {{ $pengaduans->links() }}
    </div>
</div>
@endsection