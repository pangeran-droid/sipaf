@extends('layouts.admin', ['title' => 'Tambah Jurusan - SIPAF Admin'])

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2 fw-bold">Tambah Jurusan Baru</h1>
    <a href="{{ route('admin.jurusan.index') }}" class="btn btn-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
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

                <form action="{{ route('admin.jurusan.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_jurusan" class="form-label fw-bold">Nama Jurusan</label>
                        <input type="text" class="form-control" id="nama_jurusan" name="nama_jurusan" value="{{ old('nama_jurusan') }}" placeholder="Cth: Teknik Industri" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Simpan Jurusan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection