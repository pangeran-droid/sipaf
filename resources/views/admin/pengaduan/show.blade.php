@extends('layouts.admin', ['title' => 'Detail Pengaduan - SIPAF Admin'])

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2 fw-bold">Detail Pengaduan: {{ $pengaduan->kode_pengaduan }}</h1>
    <a href="{{ route('admin.pengaduan.index') }}" class="btn btn-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row g-4">
    <!-- Informasi Pengaduan -->
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3">
                <h5 class="fw-bold mb-0"><i class="bi bi-info-circle me-2"></i>Informasi Lengkap Pengaduan</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th class="w-25 text-muted">Kode Pengaduan</th>
                        <td class="fw-bold text-primary">{{ $pengaduan->kode_pengaduan }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Nama Pengadu</th>
                        <td>{{ $pengaduan->nama_pengadu }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Jurusan</th>
                        <td><span class="badge bg-secondary">{{ $pengaduan->jurusan->nama_jurusan }}</span></td>
                    </tr>
                    <tr>
                        <th class="text-muted">Dosen Terkait</th>
                        <td>{{ $pengaduan->nama_dosen }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Status Saat Ini</th>
                        <td>
                            @if($pengaduan->status === 'Proses')
                                <span class="badge bg-info text-dark">Proses</span>
                            @elseif($pengaduan->status === 'Sedang Ditangani')
                                <span class="badge bg-warning text-dark">Sedang Ditangani</span>
                            @else
                                <span class="badge bg-success">Selesai</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="text-muted">Tanggal Dibuat</th>
                        <td>{{ $pengaduan->created_at->format('d F Y, H:i') }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Isi Pengaduan</th>
                        <td class="bg-light p-3 rounded text-secondary">{{ $pengaduan->isi_pengaduan }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- Form Update Status & History Timeline -->
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="fw-bold mb-0"><i class="bi bi-pencil-square me-2"></i>Update Status Pengaduan</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.pengaduan.updateStatus', $pengaduan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="status" class="form-label fw-bold">Status Baru</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="Proses" {{ $pengaduan->status === 'Proses' ? 'selected' : '' }}>Proses</option>
                            <option value="Sedang Ditangani" {{ $pengaduan->status === 'Sedang Ditangani' ? 'selected' : '' }}>Sedang Ditangani</option>
                            <option value="Selesai" {{ $pengaduan->status === 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="catatan" class="form-label fw-bold">Catatan Penanganan</label>
                        <textarea name="catatan" id="catatan" rows="3" class="form-control" placeholder="Tuliskan catatan atau progres penanganan..."></textarea>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan Status</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Riwayat / Timeline Pengaduan -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="fw-bold mb-0"><i class="bi bi-clock-history me-2"></i>Riwayat / Timeline</h5>
            </div>
            <div class="card-body">
                <div class="timeline ps-2">
                    @foreach($pengaduan->histories as $history)
                        <div class="mb-3 border-start ps-3 border-3 border-primary">
                            <p class="small text-muted mb-1"><i class="bi bi-calendar-event me-1"></i>{{ $history->created_at->format('d M Y, H:i') }}</p>
                            <p class="mb-1 fw-bold">
                                <span class="badge bg-secondary">{{ $history->status_sebelumnya }}</span> 
                                <i class="bi bi-arrow-right"></i> 
                                <span class="badge bg-primary">{{ $history->status_baru }}</span>
                            </p>
                            <p class="small text-secondary mb-1"><strong>Catatan:</strong> {{ $history->catatan }}</p>
                            <p class="small text-muted fst-italic mb-0"><i class="bi bi-person-fill me-1"></i>Oleh: {{ $history->user ? $history->user->name : 'Sistem / Publik' }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection