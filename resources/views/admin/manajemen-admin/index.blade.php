@extends('layouts.admin')

@section('content')

<!-- [ breadcrumb ] start -->
<div class="page-header">
    <div class="page-block">
        <div class="flex items-center justify-between flex-wrap gap-4 py-3">

            <div class="page-header-title">
                <h2 class="mb-1 text-xl font-bold text-gray-800 dark:text-white">
                    Manajemen Akun Admin
                </h2>

                <p class="text-muted mb-0">
                    Kelola akun administrator dan akses jurusan.
                </p>
            </div>

            <a
                href="{{ route('admin.manajemen-admin.create') }}"
                class="btn btn-primary">

                <i class="ti ti-user-plus me-1"></i>
                Tambah Admin

            </a>

        </div>
    </div>
</div>
<!-- [ breadcrumb ] end -->


<!-- Success Alert -->
@if(session('success'))

    <div
        class="alert alert-success alert-dismissible fade show"
        role="alert">

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

    <div
        class="alert alert-danger alert-dismissible fade show"
        role="alert">

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


<div class="card">

    <!-- Card Header -->
    <div class="card-header">

        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">

            <div class="d-flex align-items-center">

                <div>

                    <h5 class="mb-1">
                        Daftar Administrator
                    </h5>

                    <p class="text-muted mb-0 f-12">
                        Daftar akun admin yang memiliki akses ke sistem.
                    </p>

                </div>

            </div>


            <span class="badge bg-light-primary text-primary">

                <i class="ti ti-users me-1"></i>

                {{ $admins->total() }} Admin

            </span>

        </div>

    </div>


    <!-- Card Body -->
    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>

                    <tr>

                        <th>
                            Administrator
                        </th>

                        <th>
                            Email
                        </th>

                        <th>
                            Role
                        </th>

                        <th>
                            Jurusan
                        </th>

                        <th class="text-end">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($admins as $admin)

                        <tr>

                            <!-- Nama -->
                            <td>

                                <div class="d-flex align-items-center">


                                    <div>

                                        <h6 class="mb-1">
                                            {{ $admin->name }}
                                        </h6>

                                        @if($admin->id === auth()->id())

                                            <span class="badge bg-light-success text-success f-10">
                                                Akun Anda
                                            </span>

                                        @else

                                            <small class="text-muted">
                                                Administrator
                                            </small>

                                        @endif

                                    </div>

                                </div>

                            </td>


                            <!-- Email -->
                            <td>

                                <div class="d-flex align-items-center">

                                    <i class="ti ti-mail text-muted me-2"></i>

                                    <span>
                                        {{ $admin->email }}
                                    </span>

                                </div>

                            </td>


                            <!-- Role -->
                            <td>

                                @if($admin->role === 'super_admin')

                                    <span class="badge bg-light-danger text-danger">

                                        <i class="ti ti-shield-check me-1"></i>
                                        Super Admin

                                    </span>

                                @else

                                    <span class="badge bg-light-primary text-primary">

                                        <i class="ti ti-user-shield me-1"></i>
                                        Admin Jurusan

                                    </span>

                                @endif

                            </td>


                            <!-- Jurusan -->
                            <td>

                                @if($admin->jurusan)

                                    <div class="d-flex align-items-center">

                                        <div class="avtar avtar-xs bg-light-secondary me-2">
                                            <i class="ti ti-school text-secondary"></i>
                                        </div>

                                        <span>
                                            {{ $admin->jurusan->nama_jurusan }}
                                        </span>

                                    </div>

                                @else

                                    <span class="text-muted">
                                        <i class="ti ti-minus me-1"></i>
                                        Tidak terkait jurusan
                                    </span>

                                @endif

                            </td>


                            <!-- Action -->
                            <td class="text-end">

                                <div class="d-flex justify-content-end gap-2">

                                    <!-- Edit -->
                                    <a
                                        href="{{ route('admin.manajemen-admin.edit', $admin->id) }}"
                                        class="btn btn-sm btn-light-warning"
                                        title="Edit Admin">

                                        <i class="ti ti-edit me-1"></i>
                                        Edit

                                    </a>


                                    <!-- Delete -->
                                    @if($admin->id !== auth()->id())

                                        <form
                                            action="{{ route('admin.manajemen-admin.destroy', $admin->id) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus admin ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-light-danger"
                                                title="Hapus Admin">

                                                <i class="ti ti-trash me-1"></i>
                                                Hapus

                                            </button>

                                        </form>

                                    @else

                                        <button
                                            type="button"
                                            class="btn btn-sm btn-light-secondary"
                                            disabled
                                            title="Akun yang sedang digunakan tidak dapat dihapus">

                                            <i class="ti ti-lock me-1"></i>
                                            Aktif

                                        </button>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5">

                                <div class="text-center py-5">

                                    <div class="avtar avtar-xl bg-light-secondary mx-auto mb-3">

                                        <i class="ti ti-users-off f-24 text-secondary"></i>

                                    </div>

                                    <h5 class="mb-1">
                                        Belum Ada Admin
                                    </h5>

                                    <p class="text-muted mb-3">
                                        Belum ada akun administrator yang terdaftar.
                                    </p>

                                    <a
                                        href="{{ route('admin.manajemen-admin.create') }}"
                                        class="btn btn-primary">

                                        <i class="ti ti-user-plus me-1"></i>
                                        Tambah Admin

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    <!-- Pagination -->
    @if($admins->hasPages())

        <div class="card-footer">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                <div class="text-muted f-12">

                    Menampilkan

                    <strong>
                        {{ $admins->firstItem() }}
                    </strong>

                    -

                    <strong>
                        {{ $admins->lastItem() }}
                    </strong>

                    dari

                    <strong>
                        {{ $admins->total() }}
                    </strong>

                    admin

                </div>


                <div>

                    {{ $admins->withQueryString()->links() }}

                </div>

            </div>

        </div>

    @endif

</div>


@endsection
