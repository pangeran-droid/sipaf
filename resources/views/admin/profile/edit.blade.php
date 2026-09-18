@extends('layouts.admin', ['title' => 'Profile Saya - SIPAF Admin'])

@section('content')

<!-- [ breadcrumb ] start -->
<div class="page-header">
    <div class="page-block">
        <div class="flex items-center justify-between flex-wrap gap-4 py-3">

            <div class="page-header-title">
                <h2 class="mb-1 text-xl font-bold text-gray-800 dark:text-white">
                    Profile Saya
                </h2>

                <p class="text-muted mb-0">
                    Kelola informasi akun dan keamanan password Anda
                </p>
            </div>

        </div>
    </div>
</div>
<!-- [ breadcrumb ] end -->


<!-- Success -->
@if(session('status') === 'profile-updated')
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="ti ti-circle-check me-2"></i>
        Informasi profile berhasil diperbarui.

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Close">
        </button>
    </div>
@endif

@if(session('status') === 'password-updated')
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="ti ti-circle-check me-2"></i>
        Password berhasil diperbarui.

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Close">
        </button>
    </div>
@endif


<!-- Error -->
@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">

        <div class="d-flex align-items-start">

            <i class="ti ti-alert-triangle me-2 f-20"></i>

            <div>
                <strong>Terjadi kesalahan</strong>

                <ul class="mb-0 mt-1 ps-3">
                    @foreach($errors->all() as $error)
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


<div class="row">

    <div class="col-lg-7">

        <div class="card">

            <!-- Header -->
            <div class="card-header">

                <div class="d-flex align-items-center">

                    <div class="avtar avtar-s bg-light-primary me-3">
                        <i class="ti ti-user text-primary f-20"></i>
                    </div>

                    <div>
                        <h5 class="mb-1">
                            Informasi Profile
                        </h5>

                        <p class="text-muted mb-0 f-12">
                            Perbarui informasi dasar akun Anda
                        </p>
                    </div>

                </div>

            </div>


            <!-- Body -->
            <div class="card-body">

                <form
                    method="POST"
                    action="{{ route('admin.profile.update') }}">

                    @csrf
                    @method('PATCH')


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
                                id="name"
                                name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $user->name) }}"
                                placeholder="Masukkan nama lengkap"
                                required
                                autofocus
                                autocomplete="name">

                        </div>

                        @error('name')
                            <div class="text-danger f-12 mt-1">
                                {{ $message }}
                            </div>
                        @enderror

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
                                id="email"
                                name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $user->email) }}"
                                placeholder="Masukkan alamat email"
                                required
                                autocomplete="username">

                        </div>

                        @error('email')
                            <div class="text-danger f-12 mt-1">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <!-- Jurusan -->
                    @if($user->role !== 'super_admin')

                        <div class="mb-4">

                            <label class="form-label">
                                Jurusan
                            </label>

                            <div class="form-control bg-light">

                                <div class="d-flex align-items-center">

                                    <i class="ti ti-school text-primary me-2"></i>

                                    <span>
                                        {{ $user->jurusan?->nama_jurusan ?? '-' }}
                                    </span>

                                </div>

                            </div>

                        </div>

                    @endif


                    <!-- Button -->
                    <div class="d-flex justify-content-end pt-2">

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

    </div>


    <div class="col-lg-5">

        <div class="card">

            <!-- Header -->
            <div class="card-header">

                <div class="d-flex align-items-center">

                    <div class="avtar avtar-s bg-light-warning me-3">
                        <i class="ti ti-lock text-warning f-20"></i>
                    </div>

                    <div>
                        <h5 class="mb-1">
                            Ubah Password
                        </h5>

                        <p class="text-muted mb-0 f-12">
                            Perbarui password untuk keamanan akun
                        </p>
                    </div>

                </div>

            </div>


            <!-- Body -->
            <div class="card-body">

                <form
                    method="POST"
                    action="{{ route('password.update') }}">

                    @csrf
                    @method('PUT')


                    <!-- Password Lama -->
                    <div class="mb-4">

                        <label
                            for="current_password"
                            class="form-label">

                            Password Saat Ini
                            <span class="text-danger">*</span>

                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                <i class="ti ti-lock"></i>
                            </span>

                            <input
                                type="password"
                                id="current_password"
                                name="current_password"
                                class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                                placeholder="Masukkan password saat ini"
                                autocomplete="current-password"
                                required>

                        </div>

                        @error('current_password', 'updatePassword')
                            <div class="text-danger f-12 mt-1">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <!-- Password Baru -->
                    <div class="mb-4">

                        <label
                            for="password"
                            class="form-label">

                            Password Baru
                            <span class="text-danger">*</span>

                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                <i class="ti ti-key"></i>
                            </span>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control @error('password', 'updatePassword') is-invalid @enderror"
                                placeholder="Masukkan password baru"
                                autocomplete="new-password"
                                required>

                        </div>

                        @error('password', 'updatePassword')
                            <div class="text-danger f-12 mt-1">
                                {{ $message }}
                            </div>
                        @enderror

                        <small class="text-muted">
                            Gunakan password yang kuat dan sulit ditebak.
                        </small>

                    </div>


                    <!-- Konfirmasi -->
                    <div class="mb-4">

                        <label
                            for="password_confirmation"
                            class="form-label">

                            Konfirmasi Password
                            <span class="text-danger">*</span>

                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                <i class="ti ti-lock"></i>
                            </span>

                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror"
                                placeholder="Ulangi password baru"
                                autocomplete="new-password"
                                required>

                        </div>

                        @error('password_confirmation', 'updatePassword')
                            <div class="text-danger f-12 mt-1">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <!-- Button -->
                    <div class="d-grid">

                        <button
                            type="submit"
                            class="btn btn-warning">

                            <i class="ti ti-lock-check me-1"></i>
                            Perbarui Password

                        </button>

                    </div>

                </form>

            </div>

        </div>


        <!-- Security Info -->
        <div class="card">

            <div class="card-body">

                <div class="d-flex align-items-start">

                    <div class="avtar avtar-s bg-light-success me-3">
                        <i class="ti ti-shield-check text-success f-20"></i>
                    </div>

                    <div>

                        <h6 class="mb-1">
                            Keamanan Akun
                        </h6>

                        <p class="text-muted f-12 mb-0">
                            Jangan bagikan password kepada orang lain.
                            Pastikan password yang digunakan berbeda dari
                            akun lainnya.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
