@extends('layouts.public', ['title' => 'Buat Pengaduan - SIPAF'])

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white py-3">
                <h4 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Form Pengaduan Akademik</h4>
            </div>
            <div class="card-body p-4">
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('pengaduan.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_pengadu" class="form-label fw-bold">Nama Pengadu</label>
                        <input type="text" class="form-control @error('nama_pengadu') is-invalid @enderror" id="nama_pengadu" name="nama_pengadu" value="{{ old('nama_pengadu') }}" placeholder="Masukkan nama lengkap Anda" required>
                    </div>

                    <div class="mb-3">
                        <label for="jurusan_id" class="form-label fw-bold">Jurusan Pengadu</label>
                        <select class="form-select @error('jurusan_id') is-invalid @enderror" id="jurusan_id" name="jurusan_id" required>
                            <option value="" selected disabled>-- Pilih Jurusan --</option>
                            @foreach($jurusans as $jurusan)
                                <option value="{{ $jurusan->id }}" {{ old('jurusan_id') == $jurusan->id ? 'selected' : '' }}>{{ $jurusan->nama_jurusan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="nama_dosen" class="form-label fw-bold">Nama Dosen Terkait</label>
                        <input type="text" class="form-control @error('nama_dosen') is-invalid @enderror" id="nama_dosen" name="nama_dosen" value="{{ old('nama_dosen') }}" placeholder="Nama dosen yang bersangkutan (jika ada)" required>
                    </div>

                    <div class="mb-3">
                        <label for="isi_pengaduan" class="form-label fw-bold">Isi Pengaduan</label>
                        <textarea class="form-control @error('isi_pengaduan') is-invalid @enderror" id="isi_pengaduan" name="isi_pengaduan" rows="5" placeholder="Tuliskan detail pengaduan akademik Anda di sini..." required>{{ old('isi_pengaduan') }}</textarea>
                        <div class="form-text">Pastikan pengaduan disampaikan dengan bahasa yang sopan dan jelas (minimal 10 karakter).</div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary px-4">Kirim Pengaduan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection