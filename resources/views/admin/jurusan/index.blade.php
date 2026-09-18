@extends('layouts.admin')

@section('content')

<!-- [ breadcrumb ] start -->
<div class="page-header">
    <div class="page-block">

        <div class="flex items-center justify-between flex-wrap gap-4 py-3">

            <div class="page-header-title">

                <h2 class="mb-1 text-xl font-bold text-gray-800 dark:text-white">
                    Manajemen Data Jurusan
                </h2>

                <p class="text-muted mb-0">
                    Kelola data jurusan yang tersedia di dalam sistem.
                </p>

            </div>

            <a
                href="{{ route('admin.jurusan.create') }}"
                class="btn btn-primary">

                <i class="ti ti-plus me-1"></i>
                Tambah Jurusan

            </a>

        </div>

    </div>
</div>
<!-- [ breadcrumb ] end -->


<!-- Alert Success -->
@if(session('success'))

    <div
        class="alert alert-success alert-dismissible fade show"
        role="alert">

        <div class="d-flex align-items-center">

            <i class="ti ti-circle-check f-20 me-2"></i>

            <span>
                {{ session('success') }}
            </span>

        </div>

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Close">
        </button>

    </div>

@endif


<!-- Alert Error -->
@if(session('error'))

    <div
        class="alert alert-danger alert-dismissible fade show"
        role="alert">

        <div class="d-flex align-items-center">

            <i class="ti ti-alert-triangle f-20 me-2"></i>

            <span>
                {{ session('error') }}
            </span>

        </div>

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Close">
        </button>

    </div>

@endif


<!-- Data Jurusan -->
<div class="card">

    <div class="card-header">

        <div class="d-flex align-items-center justify-content-between">

            <div>

                <h5 class="mb-1">
                    Daftar Jurusan
                </h5>

                <p class="text-muted mb-0 f-12">
                    Daftar seluruh jurusan yang terdaftar.
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
                            Nama Jurusan
                        </th>

                        <th class="py-3">
                            Admin Terikat
                        </th>

                        <th class="py-3">
                            Pengaduan
                        </th>

                        <th class="py-3 text-end pe-3">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($jurusans as $index => $jurusan)

                        <tr>

                            <td class="ps-3 text-muted">
                                {{ $jurusans->firstItem() + $index }}
                            </td>


                            <td>

                                <div class="d-flex align-items-center">


                                    <div>

                                        <h6 class="mb-0">
                                            {{ $jurusan->nama_jurusan }}
                                        </h6>

                                    </div>

                                </div>

                            </td>


                            <td>

                                <span class="badge bg-light-info text-info">

                                    <i class="ti ti-users me-1"></i>

                                    {{ $jurusan->users_count }} Admin

                                </span>

                            </td>


                            <td>

                                <span class="badge bg-light-secondary text-secondary">

                                    <i class="ti ti-message-report me-1"></i>

                                    {{ $jurusan->pengaduans_count }} Pengaduan

                                </span>

                            </td>


                            <td class="text-end pe-3">

                                <div class="d-flex justify-content-end gap-2">

                                    <a
                                        href="{{ route('admin.jurusan.edit', $jurusan->id) }}"
                                        class="btn btn-sm btn-light-warning"
                                        title="Edit Jurusan">

                                        <i class="ti ti-edit"></i>
                                        Edit

                                    </a>


                                    <form
                                        action="{{ route('admin.jurusan.destroy', $jurusan->id) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus jurusan ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-light-danger"
                                            title="Hapus Jurusan">

                                            <i class="ti ti-trash"></i>
                                            Hapus

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="5"
                                class="text-center py-5">

                                <div class="text-muted">

                                    <div class="avtar avtar-l bg-light-secondary mx-auto mb-3">

                                        <i class="ti ti-building-community f-24"></i>

                                    </div>

                                    <h6 class="mb-1">
                                        Belum ada data jurusan
                                    </h6>

                                    <p class="mb-0 f-12">
                                        Silakan tambahkan jurusan baru.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    @if($jurusans->hasPages())

        <div class="card-footer">

            {{ $jurusans->links() }}

        </div>

    @endif

</div>


@endsection
