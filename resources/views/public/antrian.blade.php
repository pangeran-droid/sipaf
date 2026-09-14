@extends('layouts.public', ['title' => 'Antrian Pengaduan - SIPAF'])

@section('content')
<section id="antrian-pengaduan" class="services section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Antrian Pengaduan</h2>
        <p>
            Pantau proses penanganan pengaduan akademik secara transparan
            melalui status pengaduan berikut.
        </p>
    </div>
    <!-- End Section Title -->

    <div class="container">

        <!-- Filter -->
        <div class="row justify-content-center mb-5"
             data-aos="fade-up"
             data-aos-delay="100">

            <div class="col-lg-10">

                <form
                    id="filter-form"
                    method="GET"
                    action="{{ route('pengaduan.antrian') }}"
                >
                    <div class="filter-box">

                        <div class="row align-items-end gy-3">

                            <!-- Search -->
                            <div class="col-md-5">
                                <label for="search" class="form-label">
                                    <i class="bi bi-search me-1"></i>
                                    Kode Pengaduan
                                </label>

                                <input
                                    type="text"
                                    id="search"
                                    name="search"
                                    value="{{ request('search') }}"
                                    class="form-control"
                                    placeholder="Contoh: ADU-20260913-0001"
                                >
                            </div>

                            <!-- Jurusan -->
                            <div class="col-md-5">
                                <label for="jurusan_id" class="form-label">
                                    <i class="bi bi-mortarboard me-1"></i>
                                    Jurusan
                                </label>

                                <select
                                    id="jurusan_id"
                                    name="jurusan_id"
                                    class="form-select"
                                >
                                    <option value="">Semua Jurusan</option>

                                    @foreach($jurusans as $jurusan)
                                        <option
                                            value="{{ $jurusan->id }}"
                                            {{ request('jurusan_id') == $jurusan->id ? 'selected' : '' }}
                                        >
                                            {{ $jurusan->nama_jurusan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Button -->
                            <div class="col-md-2 d-grid">
                                <button
                                    type="submit"
                                    class="btn btn-primary"
                                >
                                    <i class="bi bi-funnel me-1"></i>
                                    Filter
                                </button>
                            </div>

                        </div>

                    </div>
                </form>

            </div>
        </div>
        <!-- End Filter -->


        <!-- Kanban -->
        <div class="row gy-4">

            <!-- ====================================================== -->
            <!-- PROSES -->
            <!-- ====================================================== -->

            <div
                class="col-lg-4"
                data-aos="fade-up"
                data-aos-delay="100"
            >

                <div class="kanban-column">

                    <!-- Header -->
                    <div class="kanban-header proses">

                        <div>
                            <span class="status-icon">
                                <i class="bi bi-hourglass-split"></i>
                            </span>

                            <div>
                                <h4>Proses</h4>
                                <span>Menunggu penanganan</span>
                            </div>
                        </div>

                        <span class="status-count">
                            {{ $prosesTotal }}
                        </span>

                    </div>
                    <!-- End Header -->


                    <!-- Body -->
                    <div class="kanban-body">

                        @forelse($proses as $item)

                            <div class="complaint-card">

                                <div class="d-flex justify-content-between align-items-start mb-3">

                                    <span class="complaint-code">
                                        {{ $item->kode_pengaduan }}
                                    </span>

                                    <i class="bi bi-hourglass-split status-symbol proses-text"></i>

                                </div>

                                <h5>
                                    {{ $item->jurusan->nama_jurusan }}
                                </h5>

                                <div class="complaint-info">

                                    <div>
                                        <i class="bi bi-person-badge"></i>
                                        <span>{{ $item->nama_dosen }}</span>
                                    </div>

                                    <div>
                                        <i class="bi bi-calendar3"></i>
                                        <span>
                                            {{ $item->created_at->format('d M Y') }}
                                        </span>
                                    </div>

                                </div>

                            </div>

                        @empty

                            <div class="empty-state">
                                <i class="bi bi-inbox"></i>
                                <p>
                                    Tidak ada pengaduan dalam status proses.
                                </p>
                            </div>

                        @endforelse


                        <!-- More -->
                        @if($prosesTotal > 5)

                            <div class="more-complaints proses-more">

                                <i class="bi bi-three-dots"></i>

                                <span>
                                    +{{ $prosesTotal - 5 }}
                                    pengaduan lainnya
                                </span>

                            </div>

                        @endif

                    </div>
                    <!-- End Body -->

                </div>

            </div>
            <!-- End Proses -->


            <!-- ====================================================== -->
            <!-- SEDANG DITANGANI -->
            <!-- ====================================================== -->

            <div
                class="col-lg-4"
                data-aos="fade-up"
                data-aos-delay="200"
            >

                <div class="kanban-column">

                    <!-- Header -->
                    <div class="kanban-header ditangani">

                        <div>
                            <span class="status-icon">
                                <i class="bi bi-gear"></i>
                            </span>

                            <div>
                                <h4>Sedang Ditangani</h4>
                                <span>Dalam proses penanganan</span>
                            </div>
                        </div>

                        <span class="status-count">
                            {{ $sedangDitanganiTotal }}
                        </span>

                    </div>
                    <!-- End Header -->


                    <!-- Body -->
                    <div class="kanban-body">

                        @forelse($sedangDitangani as $item)

                            <div class="complaint-card">

                                <div class="d-flex justify-content-between align-items-start mb-3">

                                    <span class="complaint-code">
                                        {{ $item->kode_pengaduan }}
                                    </span>

                                    <i class="bi bi-gear status-symbol ditangani-text"></i>

                                </div>

                                <h5>
                                    {{ $item->jurusan->nama_jurusan }}
                                </h5>

                                <div class="complaint-info">

                                    <div>
                                        <i class="bi bi-person-badge"></i>
                                        <span>{{ $item->nama_dosen }}</span>
                                    </div>

                                    <div>
                                        <i class="bi bi-calendar3"></i>
                                        <span>
                                            {{ $item->created_at->format('d M Y') }}
                                        </span>
                                    </div>

                                </div>

                            </div>

                        @empty

                            <div class="empty-state">
                                <i class="bi bi-inbox"></i>
                                <p>
                                    Tidak ada pengaduan sedang ditangani.
                                </p>
                            </div>

                        @endforelse


                        <!-- More -->
                        @if($sedangDitanganiTotal > 5)

                            <div class="more-complaints ditangani-more">

                                <i class="bi bi-three-dots"></i>

                                <span>
                                    +{{ $sedangDitanganiTotal - 5 }}
                                    pengaduan lainnya
                                </span>

                            </div>

                        @endif

                    </div>
                    <!-- End Body -->

                </div>

            </div>
            <!-- End Sedang Ditangani -->


            <!-- ====================================================== -->
            <!-- SELESAI -->
            <!-- ====================================================== -->

            <div
                class="col-lg-4"
                data-aos="fade-up"
                data-aos-delay="300"
            >

                <div class="kanban-column">

                    <!-- Header -->
                    <div class="kanban-header selesai">

                        <div>
                            <span class="status-icon">
                                <i class="bi bi-check-lg"></i>
                            </span>

                            <div>
                                <h4>Selesai</h4>
                                <span>Pengaduan telah ditangani</span>
                            </div>
                        </div>

                        <span class="status-count">
                            {{ $selesaiTotal }}
                        </span>

                    </div>
                    <!-- End Header -->


                    <!-- Body -->
                    <div class="kanban-body">

                        @forelse($selesai as $item)

                            <div class="complaint-card">

                                <div class="d-flex justify-content-between align-items-start mb-3">

                                    <span class="complaint-code">
                                        {{ $item->kode_pengaduan }}
                                    </span>

                                    <i class="bi bi-check-circle status-symbol selesai-text"></i>

                                </div>

                                <h5>
                                    {{ $item->jurusan->nama_jurusan }}
                                </h5>

                                <div class="complaint-info">

                                    <div>
                                        <i class="bi bi-person-badge"></i>
                                        <span>{{ $item->nama_dosen }}</span>
                                    </div>

                                    <div>
                                        <i class="bi bi-calendar3"></i>
                                        <span>
                                            {{ $item->created_at->format('d M Y') }}
                                        </span>
                                    </div>

                                </div>

                            </div>

                        @empty

                            <div class="empty-state">
                                <i class="bi bi-check-circle"></i>
                                <p>
                                    Tidak ada pengaduan selesai.
                                </p>
                            </div>

                        @endforelse


                        <!-- More -->
                        @if($selesaiTotal > 5)

                            <div class="more-complaints selesai-more">

                                <i class="bi bi-three-dots"></i>

                                <span>
                                    +{{ $selesaiTotal - 5 }}
                                    pengaduan lainnya
                                </span>

                            </div>

                        @endif

                    </div>
                    <!-- End Body -->

                </div>

            </div>
            <!-- End Selesai -->

        </div>
        <!-- End Kanban -->

    </div>

</section>
@endsection


@section('styles')
<style>

/* Filter */

.filter-box {
    background: #ffffff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.06);
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.filter-box .form-label {
    font-weight: 600;
    color: #333;
    margin-bottom: 8px;
}

.filter-box .form-control,
.filter-box .form-select {
    min-height: 46px;
    border-radius: 8px;
    border: 1px solid #dee2e6;
    padding: 10px 14px;
}

.filter-box .form-control:focus,
.filter-box .form-select:focus {
    border-color: var(--accent-color);
    box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.08);
}

.filter-box .btn {
    min-height: 46px;
    border-radius: 8px;
}


/* Kanban Column */

.kanban-column {
    background: #f8f9fa;
    border-radius: 14px;
    overflow: hidden;
    height: 100%;
    border: 1px solid #eeeeee;
}


/* Kanban Header */

.kanban-header {
    padding: 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #ffffff;
    border-bottom: 1px solid #eeeeee;
}

.kanban-header > div {
    display: flex;
    align-items: center;
    gap: 12px;
}

.kanban-header h4 {
    font-size: 18px;
    margin: 0 0 3px;
    font-weight: 700;
    color: #212529;
}

.kanban-header span:not(.status-icon):not(.status-count) {
    font-size: 13px;
    color: #777;
}


/* Status Icon */

.status-icon {
    width: 42px;
    height: 42px;
    border-radius: 10px;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 20px;
}

.status-count {
    min-width: 30px;
    height: 30px;

    padding: 0 9px;

    border-radius: 20px;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 13px;
    font-weight: 700;
}


/* Status */

/* Proses */

.kanban-header.proses {
    border-top: 3px solid #0d6efd;
}

.kanban-header.proses .status-icon {
    background: rgba(13, 110, 253, 0.1);
    color: #0d6efd;
}

.kanban-header.proses .status-count {
    background: rgba(13, 110, 253, 0.1);
    color: #0d6efd;
}


/* Ditangani */

.kanban-header.ditangani {
    border-top: 3px solid #f6b100;
}

.kanban-header.ditangani .status-icon {
    background: rgba(246, 177, 0, 0.12);
    color: #d99a00;
}

.kanban-header.ditangani .status-count {
    background: rgba(246, 177, 0, 0.12);
    color: #b17c00;
}


/* Selesai */

.kanban-header.selesai {
    border-top: 3px solid #198754;
}

.kanban-header.selesai .status-icon {
    background: rgba(25, 135, 84, 0.1);
    color: #198754;
}

.kanban-header.selesai .status-count {
    background: rgba(25, 135, 84, 0.1);
    color: #198754;
}


/* Status Text */

.proses-text {
    color: #0d6efd;
}

.ditangani-text {
    color: #d99a00;
}

.selesai-text {
    color: #198754;
}


/* Kanban Body */

.kanban-body {
    padding: 15px;
}


/* Complaint Card */

.complaint-card {
    background: #ffffff;

    padding: 18px;
    margin-bottom: 14px;

    border-radius: 10px;
    border: 1px solid #eeeeee;

    transition: all 0.3s ease;
}

.complaint-card:last-child {
    margin-bottom: 0;
}

.complaint-card:hover {
    transform: translateY(-3px);

    box-shadow:
        0 8px 25px rgba(0, 0, 0, 0.08);

    border-color:
        rgba(13, 110, 253, 0.15);
}


/* Complaint Code */

.complaint-code {
    display: inline-block;

    padding: 5px 9px;

    background: #f1f5f9;
    color: #495057;

    border-radius: 6px;

    font-size: 11px;
    font-weight: 700;

    letter-spacing: 0.3px;
}


/* Complaint Title */

.complaint-card h5 {
    font-size: 16px;
    font-weight: 700;

    color: #212529;

    margin-bottom: 14px;
}


/* Complaint Info */

.complaint-info {
    display: flex;
    flex-direction: column;

    gap: 8px;
}

.complaint-info div {
    display: flex;
    align-items: center;

    gap: 8px;

    font-size: 13px;
    color: #777;
}

.complaint-info i {
    width: 16px;
    color: #999;
}


/* More Complaint */

.more-complaints {
    margin-top: 10px;

    padding: 12px;

    display: flex;
    align-items: center;
    justify-content: center;

    gap: 5px;

    border-radius: 8px;

    background: #ffffff;

    border: 1px dashed #dee2e6;

    font-size: 13px;
    font-weight: 600;
}

.proses-more {
    color: #0d6efd;
}

.ditangani-more {
    color: #d99a00;
}

.selesai-more {
    color: #198754;
}


/* Empty State */

.empty-state {
    text-align: center;

    padding: 35px 15px;

    color: #999;
}

.empty-state i {
    display: block;

    font-size: 35px;

    margin-bottom: 10px;

    color: #ced4da;
}

.empty-state p {
    margin: 0;

    font-size: 13px;
}


/* Responsive */

@media (max-width: 991px) {

    .kanban-column {
        margin-bottom: 10px;
    }

}

</style>
@endsection
