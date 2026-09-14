@extends('layouts.admin', ['title' => 'Tambah Admin - SIPAF Admin'])

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2 fw-bold">Tambah Akun Admin Baru</h1>
    <a href="{{ route('admin.manajemen-admin.index') }}" class="btn btn-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.manajemen-admin.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">Alamat Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-bold">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label fw-bold">Role Akses</label>
                        <select name="role" id="role" class="form-select" required onchange="toggleJurusan(this.value)">
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin Jurusan</option>
                            <option value="super_admin" {{ old('role') == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                        </select>
                    </div>

                    <div class="mb-3" id="jurusanWrapper">
                        <label for="jurusan_id" class="form-label fw-bold">Jurusan</label>
                        <select name="jurusan_id" id="jurusan_id" class="form-select">
                            <option value="" selected disabled>-- Pilih Jurusan --</option>
                            @foreach($jurusans as $jurusan)
                                <option value="{{ $jurusan->id }}" {{ old('jurusan_id') == $jurusan->id ? 'selected' : '' }}>{{ $jurusan->nama_jurusan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Simpan Akun Admin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function toggleJurusan(role) {
        const wrapper = document.getElementById('jurusanWrapper');
        const select = document.getElementById('jurusan_id');
        if (role === 'super_admin') {
            wrapper.style.display = 'none';
            select.value = '';
        } else {
            wrapper.style.display = 'block';
        }
    }
    // Run on load
    document.addEventListener("DOMContentLoaded", function() {
        toggleJurusan(document.getElementById('role').value);
    });
</script>
@endpush