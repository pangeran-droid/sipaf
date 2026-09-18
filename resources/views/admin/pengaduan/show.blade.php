@extends('layouts.admin')

@section('content')

<!-- [ breadcrumb ] start -->
<div class="page-header">
    <div class="page-block">
        <div class="flex items-center justify-between flex-wrap gap-4 py-3">

            <div class="page-header-title">
                <h2 class="mb-1 text-xl font-bold text-gray-800 dark:text-white">
                    Detail Pengaduan
                </h2>

                <p class="text-muted mb-0">
                    {{ $pengaduan->kode_pengaduan }}
                </p>
            </div>

            <a
                href="{{ route('admin.pengaduan.index') }}"
                class="btn btn-light-secondary">
                <i class="ti ti-arrow-left me-1"></i>
                Kembali
            </a>

        </div>
    </div>
</div>
<!-- [ breadcrumb ] end -->

<!-- Success Alert -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">

        <i class="ti ti-circle-check me-2"></i>
        {{ session('success') }}

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Close">
        </button>

    </div>
@endif

<!-- Error Alert -->
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">

        <i class="ti ti-alert-triangle me-2"></i>
        {{ session('error') }}

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Close">
        </button>

    </div>
@endif

<div class="row">

    <div class="col-lg-7">

        <div class="card">

            <div class="card-header">

                <div class="d-flex align-items-center">

                    <div class="avtar avtar-s bg-light-primary me-3">
                        <i class="ti ti-file-description text-primary f-20"></i>
                    </div>

                    <div>
                        <h5 class="mb-1">
                            Informasi Pengaduan
                        </h5>

                        <p class="text-muted mb-0 f-12">
                            Detail lengkap pengaduan akademik
                        </p>
                    </div>

                </div>

            </div>

            <div class="card-body">

                <!-- Kode -->
                <div class="row mb-4">

                    <div class="col-sm-4">
                        <p class="text-muted mb-1">
                            Kode Pengaduan
                        </p>
                    </div>

                    <div class="col-sm-8">
                        <span class="badge bg-light-primary text-primary f-13">
                            {{ $pengaduan->kode_pengaduan }}
                        </span>
                    </div>

                </div>

                <!-- Nama Pengadu -->
                <div class="row mb-4">

                    <div class="col-sm-4">
                        <p class="text-muted mb-1">
                            Nama Pengadu
                        </p>
                    </div>

                    <div class="col-sm-8">

                        <div class="d-flex align-items-center">

                            <div class="avtar avtar-s bg-light-secondary me-2">
                                <i class="ti ti-user text-secondary"></i>
                            </div>

                            <div>
                                <h6 class="mb-0">
                                    {{ $pengaduan->nama_pengadu }}
                                </h6>

                                <small class="text-muted">
                                    Pengadu
                                </small>
                            </div>

                        </div>

                    </div>

                </div>

                <!-- Jurusan -->
                <div class="row mb-4">

                    <div class="col-sm-4">
                        <p class="text-muted mb-1">
                            Jurusan
                        </p>
                    </div>

                    <div class="col-sm-8">

                        <span class="badge bg-light-secondary text-secondary">
                            <i class="ti ti-school me-1"></i>
                            {{ $pengaduan->jurusan->nama_jurusan }}
                        </span>

                    </div>

                </div>

                <!-- Dosen -->
                <div class="row mb-4">

                    <div class="col-sm-4">
                        <p class="text-muted mb-1">
                            Dosen Terkait
                        </p>
                    </div>

                    <div class="col-sm-8">

                        <div class="d-flex align-items-center">

                            <div class="avtar avtar-s bg-light-warning me-2">
                                <i class="ti ti-user-star text-warning"></i>
                            </div>

                            <span class="fw-medium">
                                {{ $pengaduan->nama_dosen }}
                            </span>

                        </div>

                    </div>

                </div>

                <!-- Status -->
                <div class="row mb-4">

                    <div class="col-sm-4">
                        <p class="text-muted mb-1">
                            Status Saat Ini
                        </p>
                    </div>

                    <div class="col-sm-8">

                        @if($pengaduan->status === 'Proses')

                            <span class="badge bg-light-info text-info">
                                <i class="ti ti-clock me-1"></i>
                                Proses
                            </span>

                        @elseif($pengaduan->status === 'Sedang Ditangani')

                            <span class="badge bg-light-warning text-warning">
                                <i class="ti ti-loader me-1"></i>
                                Sedang Ditangani
                            </span>

                        @elseif($pengaduan->status === 'Selesai')

                            <span class="badge bg-light-success text-success">
                                <i class="ti ti-circle-check me-1"></i>
                                Selesai
                            </span>

                        @else

                            <span class="badge bg-light-secondary text-secondary">
                                {{ $pengaduan->status }}
                            </span>

                        @endif

                    </div>

                </div>

                <!-- Tanggal -->
                <div class="row mb-4">

                    <div class="col-sm-4">
                        <p class="text-muted mb-1">
                            Tanggal Dibuat
                        </p>
                    </div>

                    <div class="col-sm-8">

                        <div class="d-flex align-items-center">

                            <i class="ti ti-calendar text-muted me-2"></i>

                            <span>
                                {{ $pengaduan->created_at->format('d F Y, H:i') }}
                            </span>

                        </div>

                    </div>

                </div>

                <hr class="my-4">

                <!-- Isi Pengaduan -->
                <div>

                    <p class="text-muted mb-2">
                        Isi Pengaduan
                    </p>

                    <div class="bg-light rounded p-3">

                        <div class="d-flex">

                            <i class="ti ti-message-2 text-primary f-20 me-2 mt-1"></i>

                            <div class="text-secondary" style="white-space: pre-line;">
                                {{ $pengaduan->isi_pengaduan }}
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-5">

        <!-- UPDATE STATUS -->
        <div class="card">

            <div class="card-header">

                <div class="d-flex align-items-center">

                    <div class="avtar avtar-s bg-light-primary me-3">
                        <i class="ti ti-edit text-primary f-20"></i>
                    </div>

                    <div>
                        <h5 class="mb-1">
                            Update Status
                        </h5>

                        <p class="text-muted mb-0 f-12">
                            Perbarui status dan catatan penanganan
                        </p>
                    </div>

                </div>

            </div>

            <div class="card-body">

                <form
                    action="{{ route('admin.pengaduan.updateStatus', $pengaduan->id) }}"
                    method="POST">

                    @csrf
                    @method('PUT')

                    <!-- Status -->
                    <div class="mb-4">

                        <label
                            for="status"
                            class="form-label">

                            Status Baru
                            <span class="text-danger">*</span>

                        </label>

                        <select
                            name="status"
                            id="status"
                            class="form-select"
                            required>

                            <option
                                value="Proses"
                                {{ $pengaduan->status === 'Proses' ? 'selected' : '' }}>
                                Proses
                            </option>

                            <option
                                value="Sedang Ditangani"
                                {{ $pengaduan->status === 'Sedang Ditangani' ? 'selected' : '' }}>
                                Sedang Ditangani
                            </option>

                            <option
                                value="Selesai"
                                {{ $pengaduan->status === 'Selesai' ? 'selected' : '' }}>
                                Selesai
                            </option>

                        </select>

                    </div>

                    <!-- Catatan -->
                    <div class="mb-4">

                        <label
                            for="catatan"
                            class="form-label">

                            Catatan Penanganan
                        </label>

                        <textarea
                            name="catatan"
                            id="catatan"
                            rows="5"
                            class="form-control"
                            placeholder="Tuliskan catatan atau progres penanganan..."></textarea>

                        <small class="text-muted">
                            Catatan akan tersimpan di riwayat pengaduan.
                        </small>

                    </div>

                    <!-- Submit -->
                    <div class="d-grid">

                        <button
                            type="submit"
                            class="btn btn-primary">

                            <i class="ti ti-device-floppy me-1"></i>
                            Simpan Perubahan

                        </button>

                    </div>

                </form>

            </div>

        </div>

        <div class="card">

            <div class="card-header">

                <div class="d-flex align-items-center">

                    <div class="avtar avtar-s bg-light-info me-3">
                        <i class="ti ti-history text-info f-20"></i>
                    </div>

                    <div>
                        <h5 class="mb-1">
                            Riwayat Pengaduan
                        </h5>

                        <p class="text-muted mb-0 f-12">
                            Perubahan status dan catatan penanganan
                        </p>
                    </div>

                </div>

            </div>

            <div class="card-body">

                @forelse($pengaduan->histories as $history)

                    <div class="d-flex mb-4">

                        <!-- Timeline Icon -->
                        <div class="flex-shrink-0">

                            <div class="avtar avtar-s bg-light-primary">
                                <i class="ti ti-history text-primary"></i>
                            </div>

                        </div>

                        <!-- Timeline Content -->
                        <div class="flex-grow-1 ms-3">

                            <!-- Date -->
                            <div class="d-flex justify-content-between align-items-start mb-2">

                                <span class="text-muted f-12">
                                    <i class="ti ti-calendar me-1"></i>
                                    {{ $history->created_at->format('d M Y, H:i') }}
                                </span>

                            </div>

                            <!-- Status Change -->
                            <div class="d-flex align-items-center flex-wrap gap-2 mb-2">

                                <span class="badge bg-light-secondary text-secondary">
                                    {{ $history->status_sebelumnya }}
                                </span>

                                <i class="ti ti-arrow-right text-muted"></i>

                                @if($history->status_baru === 'Proses')

                                    <span class="badge bg-light-info text-info">
                                        {{ $history->status_baru }}
                                    </span>

                                @elseif($history->status_baru === 'Sedang Ditangani')

                                    <span class="badge bg-light-warning text-warning">
                                        {{ $history->status_baru }}
                                    </span>

                                @elseif($history->status_baru === 'Selesai')

                                    <span class="badge bg-light-success text-success">
                                        {{ $history->status_baru }}
                                    </span>

                                @else

                                    <span class="badge bg-light-primary text-primary">
                                        {{ $history->status_baru }}
                                    </span>

                                @endif

                            </div>

                            <!-- Catatan -->
                            @if($history->catatan)

                                <div class="bg-light rounded p-3 mb-2">

                                    <p class="text-muted f-12 mb-1">
                                        Catatan
                                    </p>

                                    <p class="mb-0 text-secondary"
                                       style="white-space: pre-line;">
                                        {{ $history->catatan }}
                                    </p>

                                </div>

                            @endif

                            <!-- User -->
                            <p class="text-muted f-12 mb-0">

                                <i class="ti ti-user me-1"></i>

                                Oleh:
                                <span class="fw-medium">
                                    {{ $history->user ? $history->user->name : 'Sistem / Publik' }}
                                </span>

                            </p>

                        </div>

                    </div>

                    @if(!$loop->last)
                        <hr class="my-3">
                    @endif

                @empty

                    <div class="text-center py-4">

                        <div class="avtar avtar-xl bg-light-secondary mx-auto mb-3">
                            <i class="ti ti-history f-24 text-secondary"></i>
                        </div>

                        <h6 class="mb-1">
                            Belum Ada Riwayat
                        </h6>

                        <p class="text-muted f-12 mb-0">
                            Belum ada perubahan status pada pengaduan ini.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</div>

@endsection
