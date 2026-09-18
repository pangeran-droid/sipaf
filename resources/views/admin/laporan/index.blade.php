@extends('layouts.admin')

@section('content')

<!-- [ breadcrumb ] start -->
<div class="page-header">
    <div class="page-block">

        <div class="flex items-center justify-between flex-wrap gap-4 py-3">

            <div class="page-header-title">

                <h2 class="mb-1 text-xl font-bold text-gray-800 dark:text-white">
                    Laporan Pengaduan Akademik
                </h2>

                <p class="text-muted mb-0">
                    Rekapitulasi dan pencarian data pengaduan akademik.
                </p>

            </div>

            <button
                type="button"
                onclick="window.print()"
                class="btn btn-light-primary">

                <i class="ti ti-printer me-1"></i>
                Cetak / Export PDF

            </button>

        </div>

    </div>
</div>
<!-- [ breadcrumb ] end -->

<!-- Filter Laporan -->
<div class="card mb-4">

    <div class="card-header">

        <div class="d-flex align-items-center">

            <div>

                <h5 class="mb-1">
                    Filter Laporan
                </h5>

                <p class="text-muted mb-0 f-12">
                    Gunakan filter untuk menampilkan data sesuai kebutuhan.
                </p>

            </div>

        </div>

    </div>

    <div class="card-body">

        <form
            method="GET"
            action="{{ route('admin.laporan.index') }}">

            <div class="row">

                <!-- Jurusan -->
                @if(auth()->user()->role === 'super_admin')

                    <div class="col-md-3 mb-3">

                        <label
                            for="jurusan_id"
                            class="form-label">

                            Jurusan

                        </label>

                        <select
                            name="jurusan_id"
                            id="jurusan_id"
                            class="form-select">

                            <option value="">
                                -- Semua Jurusan --
                            </option>

                            @foreach($jurusans as $jurusan)

                                <option
                                    value="{{ $jurusan->id }}"
                                    {{ request('jurusan_id') == $jurusan->id ? 'selected' : '' }}>

                                    {{ $jurusan->nama_jurusan }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                @endif

                <!-- Status -->
                <div class="col-md-{{ auth()->user()->role === 'super_admin' ? '2' : '3' }} mb-3">

                    <label
                        for="status"
                        class="form-label">

                        Status

                    </label>

                    <select
                        name="status"
                        id="status"
                        class="form-select">

                        <option value="">
                            -- Semua Status --
                        </option>

                        <option
                            value="Proses"
                            {{ request('status') == 'Proses' ? 'selected' : '' }}>

                            Proses

                        </option>

                        <option
                            value="Sedang Ditangani"
                            {{ request('status') == 'Sedang Ditangani' ? 'selected' : '' }}>

                            Sedang Ditangani

                        </option>

                        <option
                            value="Selesai"
                            {{ request('status') == 'Selesai' ? 'selected' : '' }}>

                            Selesai

                        </option>

                    </select>

                </div>

                <!-- Tanggal Mulai -->
                <div class="col-md-3 mb-3">

                    <label
                        for="tanggal_mulai"
                        class="form-label">

                        Tanggal Mulai

                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="ti ti-calendar"></i>
                        </span>

                        <input
                            type="date"
                            class="form-control"
                            id="tanggal_mulai"
                            name="tanggal_mulai"
                            value="{{ request('tanggal_mulai') }}">

                    </div>

                </div>

                <!-- Tanggal Selesai -->
                <div class="col-md-3 mb-3">

                    <label
                        for="tanggal_selesai"
                        class="form-label">

                        Tanggal Selesai

                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="ti ti-calendar"></i>
                        </span>

                        <input
                            type="date"
                            class="form-control"
                            id="tanggal_selesai"
                            name="tanggal_selesai"
                            value="{{ request('tanggal_selesai') }}">

                    </div>

                </div>

                <!-- Buttons -->
                <div class="col-12">

                    <div class="d-flex justify-content-end gap-2 mt-2">

                        <a
                            href="{{ route('admin.laporan.index') }}"
                            class="btn btn-light-secondary">

                            <i class="ti ti-refresh me-1"></i>
                            Reset

                        </a>

                        <button
                            type="submit"
                            class="btn btn-primary">

                            <i class="ti ti-filter me-1"></i>
                            Terapkan Filter

                        </button>

                    </div>

                </div>

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
<div class="card">

    <div class="card-header">

        <div class="d-flex align-items-center justify-content-between">

            <div>

                <h5 class="mb-1">
                    Rekapitulasi Pengaduan
                </h5>

                <p class="text-muted mb-0 f-12">
                    Data pengaduan berdasarkan filter yang dipilih.
                </p>

            </div>

        </div>

    </div>

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead>

                    <tr>

                        <th class="py-3 ps-3">
                            No
                        </th>

                        <th class="py-3">
                            Kode Pengaduan
                        </th>

                        <th class="py-3">
                            Nama Pengadu
                        </th>

                        <th class="py-3">
                            Jurusan
                        </th>

                        <th class="py-3">
                            Dosen Terkait
                        </th>

                        <th class="py-3">
                            Status
                        </th>

                        <th class="py-3 pe-3">
                            Tanggal
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($pengaduans as $index => $item)

                        <tr>

                            <td class="ps-3 text-muted">

                                {{ $index + 1 }}

                            </td>

                            <td>

                                <span class="fw-semibold text-primary">

                                    {{ $item->kode_pengaduan }}

                                </span>

                            </td>

                            <td>

                                <div class="d-flex align-items-center">

                                    <span>
                                        {{ $item->nama_pengadu }}
                                    </span>

                                </div>

                            </td>

                            <td>

                                <span class="text-muted">

                                    {{ $item->jurusan->nama_jurusan }}

                                </span>

                            </td>

                            <td>

                                {{ $item->nama_dosen }}

                            </td>

                            <td>

                                @if($item->status === 'Proses')

                                    <span class="badge bg-light-warning text-warning">

                                        <i class="ti ti-clock me-1"></i>
                                        Proses

                                    </span>

                                @elseif($item->status === 'Sedang Ditangani')

                                    <span class="badge bg-light-info text-info">

                                        <i class="ti ti-progress me-1"></i>
                                        Sedang Ditangani

                                    </span>

                                @else

                                    <span class="badge bg-light-success text-success">

                                        <i class="ti ti-circle-check me-1"></i>
                                        Selesai

                                    </span>

                                @endif

                            </td>

                            <td class="pe-3">

                                <div class="d-flex align-items-center">


                                    <div>

                                        <div class="text-dark">
                                            {{ $item->created_at->format('d M Y') }}
                                        </div>

                                        <small class="text-muted">
                                            {{ $item->created_at->format('H:i') }}
                                        </small>

                                    </div>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="text-center py-5">

                                <div class="text-muted">

                                    <div class="avtar avtar-l bg-light-secondary mx-auto mb-3">

                                        <i class="ti ti-file-search f-24"></i>

                                    </div>

                                    <h6 class="mb-1">
                                        Tidak ada data laporan
                                    </h6>

                                    <p class="mb-0 f-12">
                                        Tidak ditemukan pengaduan untuk kriteria yang dipilih.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

<!-- Print Style -->
<style>
    @media print {
        .pc-header,
        .pc-sidebar,
        .pc-footer,
        .btn,
        .page-header,
        .card-header .d-flex button {
            display: none !important;
        }
        html, body, .pc-container, .pc-content, .container, .container-fluid {
            width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            background: #fff !important;
            color: #000 !important;
        }
        .row > [class*="col-"] {
            flex: 0 0 100% !important;
            max-width: 100% !important;
            width: 100% !important;
            padding: 0 !important;
        }
        .card {
            width: 100% !important;
            box-shadow: none !important;
            border: none !important;
            margin-bottom: 20px !important;
            break-inside: avoid;
        }
        .card-body {
            padding: 0 !important;
        }
        .table-responsive {
            overflow: visible !important;
            width: 100% !important;
        }
        table {
            width: 100% !important;
            border-collapse: collapse !important;
        }
        th, td {
            padding: 8px !important;
            border-bottom: 1px solid #ddd !important;
        }
        form {
            display: none !important;
        }
        .card:has(.table), .card:has(.ti-history) {
            display: block !important;
        }
    }
</style>

@endsection
