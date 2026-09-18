@extends('layouts.admin')

@section('content')

<!-- [ breadcrumb ] start -->
<div class="page-header">
    <div class="page-block">
        <div class="flex items-center justify-between flex-wrap gap-4 py-3">
            <div class="page-header-title">
                <h2 class="mb-0 text-xl font-bold text-gray-800 dark:text-white">
                    Daftar Pengaduan Akademik
                </h2>
                <p class="text-muted mt-1 mb-0">
                    Kelola dan pantau seluruh pengaduan akademik yang masuk.
                </p>
            </div>
        </div>
    </div>
</div>
<!-- [ breadcrumb ] end -->


<!-- Alert Success -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="ti ti-circle-check me-2"></i>
        {{ session('success') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close">
        </button>
    </div>
@endif


<!-- Filter -->
<div class="card">
    <div class="card-body">

        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <h5 class="mb-1">Filter Pengaduan</h5>
                <p class="text-muted mb-0">
                    Gunakan filter untuk mencari pengaduan tertentu.
                </p>
            </div>

        </div><br>

        <form method="GET" action="{{ route('admin.pengaduan.index') }}">

            <div class="row g-3">

                <!-- Search -->
                <div class="col-md-4">
                    <label class="form-label">
                        Cari Pengaduan
                    </label>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="ti ti-search"></i>
                        </span>

                        <input
                            type="text"
                            class="form-control"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Kode / Nama Pengadu">
                    </div>
                </div>


                <!-- Jurusan -->
                @if(auth()->user()->role === 'super_admin')
                    <div class="col-md-3">
                        <label class="form-label">
                            Jurusan
                        </label>

                        <select name="jurusan_id" class="form-select">
                            <option value="">Semua Jurusan</option>

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
                <div class="col-md-3">
                    <label class="form-label">
                        Status
                    </label>

                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>

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


                <!-- Action -->
                <div class="col-md-2 d-flex align-items-end gap-2">

                    <button
                        type="submit"
                        class="btn btn-primary flex-fill">
                        <i class="ti ti-filter me-1"></i>
                        Filter
                    </button>

                    <a
                        href="{{ route('admin.pengaduan.index') }}"
                        class="btn btn-light"
                        title="Reset Filter">
                        <i class="ti ti-refresh"></i>
                    </a>

                </div>

            </div>

        </form>

    </div>
</div>


<!-- Table Pengaduan -->
<div class="card">

    <div class="card-body">

        <!-- Table Header -->
        <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">

            <div>
                <h5 class="mb-1">
                    Data Pengaduan
                </h5>

                <p class="text-muted mb-0">
                    Daftar pengaduan akademik yang telah masuk.
                </p>
            </div>

            <div class="text-muted f-12">
                Total:
                <strong>
                    {{ $pengaduans->total() }}
                </strong>
                pengaduan
            </div>

        </div>


        <!-- Table -->
        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>
                    <tr>

                        <th>
                            Kode
                        </th>

                        <th>
                            Nama Pengadu
                        </th>

                        <th>
                            Jurusan
                        </th>

                        <th>
                            Dosen Terkait
                        </th>

                        <th>
                            Status
                        </th>

                        <th>
                            Tanggal
                        </th>

                        <th class="text-end">
                            Aksi
                        </th>

                    </tr>
                </thead>

                <tbody>

                    @forelse($pengaduans as $item)

                        <tr>

                            <!-- Kode -->
                            <td>
                                <span class="fw-semibold text-primary">
                                    {{ $item->kode_pengaduan }}
                                </span>
                            </td>


                            <!-- Nama -->
                            <td>

                                <div class="d-flex align-items-center">

                                    <div>
                                        <h6 class="mb-0">
                                            {{ $item->nama_pengadu }}
                                        </h6>

                                        <small class="text-muted">
                                            Pengadu
                                        </small>
                                    </div>

                                </div>

                            </td>


                            <!-- Jurusan -->
                            <td>
                                <span class="text-muted">
                                    {{ $item->jurusan->nama_jurusan }}
                                </span>
                            </td>


                            <!-- Dosen -->
                            <td>
                                <span class="text-muted">
                                    {{ $item->nama_dosen }}
                                </span>
                            </td>


                            <!-- Status -->
                            <td>

                                @if($item->status === 'Proses')

                                    <span class="badge bg-light-info text-info">
                                        <i class="ti ti-clock me-1"></i>
                                        Proses
                                    </span>

                                @elseif($item->status === 'Sedang Ditangani')

                                    <span class="badge bg-light-warning text-warning">
                                        <i class="ti ti-loader me-1"></i>
                                        Sedang Ditangani
                                    </span>

                                @elseif($item->status === 'Selesai')

                                    <span class="badge bg-light-success text-success">
                                        <i class="ti ti-circle-check me-1"></i>
                                        Selesai
                                    </span>

                                @else

                                    <span class="badge bg-light-secondary text-secondary">
                                        {{ $item->status }}
                                    </span>

                                @endif

                            </td>


                            <!-- Tanggal -->
                            <td>

                                <div>
                                    <span class="d-block">
                                        {{ $item->created_at->format('d M Y') }}
                                    </span>

                                    <small class="text-muted">
                                        {{ $item->created_at->format('H:i') }}
                                    </small>
                                </div>

                            </td>


                            <!-- Action -->
                            <td class="text-end">

                                <a
                                    href="{{ route('admin.pengaduan.show', $item->id) }}"
                                    class="btn btn-sm btn-light-primary"
                                    title="Lihat Detail">

                                    <i class="ti ti-eye me-1"></i>
                                    Detail

                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7">

                                <div class="text-center py-5">

                                    <div class="avtar avtar-xl bg-light-secondary mx-auto mb-3">
                                        <i class="ti ti-inbox f-24 text-secondary"></i>
                                    </div>

                                    <h5 class="mb-1">
                                        Tidak Ada Data
                                    </h5>

                                    <p class="text-muted mb-0">
                                        Tidak ada pengaduan yang sesuai dengan filter.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    <!-- Pagination -->
    @if($pengaduans->hasPages())

        <div class="card-footer">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                <div class="text-muted f-12">
                    Menampilkan
                    <strong>{{ $pengaduans->firstItem() }}</strong>
                    -
                    <strong>{{ $pengaduans->lastItem() }}</strong>
                    dari
                    <strong>{{ $pengaduans->total() }}</strong>
                    data
                </div>

                <div>
                    {{ $pengaduans->withQueryString()->links() }}
                </div>

            </div>

        </div>

    @endif

</div>


@endsection
