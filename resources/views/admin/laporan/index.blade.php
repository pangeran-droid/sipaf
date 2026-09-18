@extends('layouts.admin', ['title' => 'Laporan Pengaduan - SIPAF Admin'])

@section('content')

<!-- [ breadcrumb ] start -->
<div class="page-header">
    <div class="page-block">
        <div class="flex items-center justify-between flex-wrap gap-4 py-3">
            <div class="page-header-title">
                <h2 class="mb-0 text-xl font-bold text-gray-800 dark:text-white">Laporan Rekapitulasi Pengaduan Akademik</h2>
            </div>
            <button onclick="window.print()" class="btn btn-outline-primary"><i class="bi bi-printer me-1"></i>Cetak / Export PDF</button>
        </div>
    </div>
</div>
<!-- [ breadcrumb ] end -->

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
                <button type="submit" class="btn btn-primary w-100"><i class="text-lg leading-none ti ti-filter"></i></button>
            </div>
        </form>
    </div>
</div>

<!-- Statistik Ringkas Laporan -->
<div class="grid grid-cols-12 gap-x-6">

    <!-- Total Laporan -->
    <div class="col-span-12 md:col-span-6 2xl:col-span-3">
        <div class="card">
            <div class="card-body">
                <div class="flex items-center">

                    <div class="shrink-0">
                        <div class="w-10 h-10 rounded-xl inline-flex items-center justify-center bg-primary-500/10 text-primary-500">
                            <i class="ti ti-message-report text-2xl"></i>
                        </div>
                    </div>

                    <div class="grow ltr:ml-3 rtl:mr-3">
                        <h6 class="mb-1">Total Laporan</h6>
                        <h4 class="mb-0">{{ number_format($totalLaporan) }}</h4>
                    </div>

                </div>

                <div class="mt-4">
                    <p class="text-muted mb-0">
                        <i class="ti ti-chart-bar"></i>
                        Seluruh laporan
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Proses -->
    <div class="col-span-12 md:col-span-6 2xl:col-span-3">
        <div class="card">
            <div class="card-body">
                <div class="flex items-center">

                    <div class="shrink-0">
                        <div class="w-10 h-10 rounded-xl inline-flex items-center justify-center bg-warning-500/10 text-warning-500">
                            <i class="ti ti-clock text-2xl"></i>
                        </div>
                    </div>

                    <div class="grow ltr:ml-3 rtl:mr-3">
                        <h6 class="mb-1">Proses</h6>
                        <h4 class="mb-0">{{ number_format($totalProses) }}</h4>
                    </div>

                </div>

                <div class="mt-4">
                    <p class="text-warning-500 mb-0">
                        <i class="ti ti-loader"></i>
                        Sedang diproses
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Sedang Ditangani -->
    <div class="col-span-12 md:col-span-6 2xl:col-span-3">
        <div class="card">
            <div class="card-body">
                <div class="flex items-center">

                    <div class="shrink-0">
                        <div class="w-10 h-10 rounded-xl inline-flex items-center justify-center bg-info-500/10 text-info-500">
                            <i class="ti ti-user-search text-2xl"></i>
                        </div>
                    </div>

                    <div class="grow ltr:ml-3 rtl:mr-3">
                        <h6 class="mb-1">Sedang Ditangani</h6>
                        <h4 class="mb-0">{{ number_format($totalDitangani) }}</h4>
                    </div>

                </div>

                <div class="mt-4">
                    <p class="text-info-500 mb-0">
                        <i class="ti ti-progress"></i>
                        Dalam penanganan
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Selesai -->
    <div class="col-span-12 md:col-span-6 2xl:col-span-3">
        <div class="card">
            <div class="card-body">
                <div class="flex items-center">

                    <div class="shrink-0">
                        <div class="w-10 h-10 rounded-xl inline-flex items-center justify-center bg-success-500/10 text-success-500">
                            <i class="ti ti-circle-check text-2xl"></i>
                        </div>
                    </div>

                    <div class="grow ltr:ml-3 rtl:mr-3">
                        <h6 class="mb-1">Selesai</h6>
                        <h4 class="mb-0">{{ number_format($totalSelesai) }}</h4>
                    </div>

                </div>

                <div class="mt-4">
                    <p class="text-success-500 mb-0">
                        <i class="ti ti-check"></i>
                        Pengaduan terselesaikan
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Grafik pengaduan bulanan -->
<div class="grid grid-cols-12 gap-x-6 mt-5" id="pengaduan-bulanan-chart">
    <div class="col-span-12">
        <div class="card">
            <div class="card-body">
                <div class="flex items-center">

                    <!-- Information -->
                    <div class="grow ltr:ml-4 rtl:mr-4">

                        <h5 class="mb-1">
                            Pengaduan Bulanan
                        </h5>

                        <p class="text-muted mb-0">
                            <strong>
                                Statistik pengaduan tahun {{ $tahunIni }}
                            </strong>.
                        </p>

                    </div>
                </div>
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
