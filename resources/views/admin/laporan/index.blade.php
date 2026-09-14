@extends('layouts.admin', ['title' => 'Laporan Pengaduan - SIPAF Admin'])

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2 fw-bold">Laporan Rekapitulasi Pengaduan Akademik</h1>
    <button onclick="window.print()" class="btn btn-outline-primary"><i class="bi bi-printer me-1"></i>Cetak / Export PDF</button>
</div>

<!-- Filter Laporan -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.laporan.index') }}" class="row g-3">
            @if(auth()->user()->role === 'super_admin')
                <div class="col-md-3">
                    <label class="form-label fw-bold small">Jurusan</label>
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

            <div class="col-md-{{ auth()->user()->role === 'super_admin' ? '2' : '3' }}">
                <label class="form-label fw-bold small">Status</label>
                <select name="status" class="form-select">
                    <option value="">-- Semua Status --</option>
                    <option value="Proses" {{ request('status') == 'Proses' ? 'selected' : '' }}>Proses</option>
                    <option value="Sedang Ditangani" {{ request('status') == 'Sedang Ditangani' ? 'selected' : '' }}>Sedang Ditangani</option>
                    <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label fw-bold small">Tanggal Mulai</label>
                <input type="date" class="form-control" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}">
            </div>

            <div class="col-md-3">
                <label class="form-label fw-bold small">Tanggal Selesai</label>
                <input type="date" class="form-control" name="tanggal_selesai" value="{{ request('tanggal_selesai') }}">
            </div>

            <div class="col-md-1 d-grid align-items-end">
                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-filter"></i></button>
            </div>
        </form>
    </div>
</div>

<!-- Statistik Ringkas Laporan -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-light">
            <div class="card-body">
                <h6 class="text-muted text-uppercase fw-semibold mb-1">Total Laporan</h6>
                <h3 class="fw-bold mb-0 text-primary">{{ $totalLaporan }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-light">
            <div class="card-body">
                <h6 class="text-muted text-uppercase fw-semibold mb-1">Proses</h6>
                <h3 class="fw-bold mb-0 text-info">{{ $totalProses }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-light">
            <div class="card-body">
                <h6 class="text-muted text-uppercase fw-semibold mb-1">Sedang Ditangani</h6>
                <h3 class="fw-bold mb-0 text-warning">{{ $totalDitangani }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-light">
            <div class="card-body">
                <h6 class="text-muted text-uppercase fw-semibold mb-1">Selesai</h6>
                <h3 class="fw-bold mb-0 text-success">{{ $totalSelesai }}</h3>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Laporan -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th class="py-3 ps-3">No</th>
                        <th class="py-3">Kode Pengaduan</th>
                        <th class="py-3">Nama Pengadu</th>
                        <th class="py-3">Jurusan</th>
                        <th class="py-3">Dosen Terkait</th>
                        <th class="py-3">Status</th>
                        <th class="py-3 pe-3">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengaduans as $index => $item)
                        <tr>
                            <td class="ps-3">{{ $index + 1 }}</td>
                            <td class="fw-bold text-primary">{{ $item->kode_pengaduan }}</td>
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
                            <td class="pe-3 text-muted small">{{ $item->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">Tidak ada data laporan untuk kriteria yang dipilih.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection