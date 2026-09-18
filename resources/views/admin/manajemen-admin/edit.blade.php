@extends('layouts.admin')

@section('content')

<!-- [ breadcrumb ] start -->
<div class="page-header">
    <div class="page-block">

        <div class="flex items-center justify-between flex-wrap gap-4 py-3">

            <div class="page-header-title">

                <h2 class="mb-1 text-xl font-bold text-gray-800 dark:text-white">
                    Edit Admin
                </h2>

                <p class="text-muted mb-0">
                    Perbarui informasi akun {{ $admin->name }}.
                </p>

            </div>

            <a
                href="{{ route('admin.manajemen-admin.index') }}"
                class="btn btn-light-secondary">

                <i class="ti ti-arrow-left me-1"></i>
                Kembali

            </a>

        </div>

    </div>
</div>
<!-- [ breadcrumb ] end -->


<div class="row justify-content-center">

    <div class="col-xl-8 col-lg-9">

        <div class="card">

            <!-- Card Header -->
            <div class="card-header">

                <div class="d-flex align-items-center">

                    <div class="avtar avtar-s bg-light-warning me-3">

                        <span class="text-warning fw-semibold">
                            {{ strtoupper(substr($admin->name, 0, 1)) }}
                        </span>

                    </div>

                    <div>

                        <h5 class="mb-1">
                            Edit Informasi Admin
                        </h5>

                        <p class="text-muted mb-0 f-12">
                            Perbarui data akun administrator.
                        </p>

                    </div>

                </div>

            </div>


            <!-- Card Body -->
            <div class="card-body">

                @if ($errors->any())

                    <div
                        class="alert alert-danger alert-dismissible fade show"
                        role="alert">

                        <div class="d-flex">

                            <i class="ti ti-alert-triangle f-20 me-2"></i>

                            <div>

                                <h6 class="alert-heading mb-1">
                                    Terdapat kesalahan
                                </h6>

                                <ul class="mb-0 ps-3">

                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach

                                </ul>

                            </div>

                        </div>

                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                            aria-label="Close">
                        </button>

                    </div>

                @endif


                <form
                    action="{{ route('admin.manajemen-admin.update', $admin->id) }}"
                    method="POST">

                    @csrf
                    @method('PUT')


                    <!-- Nama -->
                    <div class="mb-4">

                        <label
                            for="name"
                            class="form-label">

                            Nama Lengkap
                            <span class="text-danger">*</span>

                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                <i class="ti ti-user"></i>
                            </span>

                            <input
                                type="text"
                                class="form-control"
                                id="name"
                                name="name"
                                value="{{ old('name', $admin->name) }}"
                                placeholder="Masukkan nama lengkap"
                                required>

                        </div>

                    </div>


                    <!-- Email -->
                    <div class="mb-4">

                        <label
                            for="email"
                            class="form-label">

                            Alamat Email
                            <span class="text-danger">*</span>

                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                <i class="ti ti-mail"></i>
                            </span>

                            <input
                                type="email"
                                class="form-control"
                                id="email"
                                name="email"
                                value="{{ old('email', $admin->email) }}"
                                placeholder="contoh@email.com"
                                required>

                        </div>

                    </div>


                    <!-- Password -->
                    <div class="mb-4">

                        <label
                            for="password"
                            class="form-label">

                            Password Baru

                            <span class="text-muted fw-normal f-12">
                                (Opsional)
                            </span>

                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                <i class="ti ti-lock"></i>
                            </span>

                            <input
                                type="password"
                                class="form-control"
                                id="password"
                                name="password"
                                placeholder="Masukkan password baru">

                        </div>

                        <small class="text-muted">
                            Kosongkan jika tidak ingin mengubah password saat ini.
                        </small>

                    </div>


                    <!-- Role -->
                    <div class="mb-4">

                        <label
                            for="role"
                            class="form-label">

                            Role Akses
                            <span class="text-danger">*</span>

                        </label>

                        <select
                            name="role"
                            id="role"
                            class="form-select"
                            required
                            onchange="toggleJurusan(this.value)">

                            <option
                                value="admin"
                                {{ old('role', $admin->role) == 'admin' ? 'selected' : '' }}>

                                Admin Jurusan

                            </option>

                            <option
                                value="super_admin"
                                {{ old('role', $admin->role) == 'super_admin' ? 'selected' : '' }}>

                                Super Admin

                            </option>

                        </select>

                    </div>


                    <!-- Jurusan -->
                    <div
                        class="mb-4"
                        id="jurusanWrapper">

                        <label
                            for="jurusan_id"
                            class="form-label">

                            Jurusan
                            <span class="text-danger">*</span>

                        </label>

                        <select
                            name="jurusan_id"
                            id="jurusan_id"
                            class="form-select">

                            <option
                                value=""
                                disabled>

                                -- Pilih Jurusan --

                            </option>

                            @foreach($jurusans as $jurusan)

                                <option
                                    value="{{ $jurusan->id }}"
                                    {{ old('jurusan_id', $admin->jurusan_id) == $jurusan->id ? 'selected' : '' }}>

                                    {{ $jurusan->nama_jurusan }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    <hr class="my-4">


                    <!-- Action -->
                    <div class="d-flex justify-content-end gap-2">

                        <a
                            href="{{ route('admin.manajemen-admin.index') }}"
                            class="btn btn-light-secondary">

                            <i class="ti ti-x me-1"></i>
                            Batal

                        </a>

                        <button
                            type="submit"
                            class="btn btn-primary">

                            <i class="ti ti-device-floppy me-1"></i>
                            Perbarui Akun Admin

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>


@endsection

@push('scripts')

<script> function toggleJurusan(role) { const wrapper = document.getElementById('jurusanWrapper'); const select = document.getElementById('jurusan_id'); if (role === 'super_admin') { wrapper.style.display = 'none'; select.value = ''; } else { wrapper.style.display = 'block'; } } document.addEventListener('DOMContentLoaded', function () { const role = document.getElementById('role'); if (role) { toggleJurusan(role.value); } }); </script>

@endpush
