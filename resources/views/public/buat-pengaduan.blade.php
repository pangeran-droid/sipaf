@extends('layouts.public', ['title' => 'Buat Pengaduan - SIPAF'])

@section('content')

<section id="buat-pengaduan" class="contact section">
<!-- Section Title -->
<div class="container section-title" data-aos="fade-up">
    <h2>Buat Pengaduan</h2>
    <p>
        Sampaikan pengaduan akademik Anda dengan jelas dan lengkap.
        Kami akan menindaklanjuti setiap pengaduan yang masuk.
    </p>
</div>
<!-- End Section Title -->


<div class="container" data-aos="fade-up" data-aos-delay="100">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <!-- Success Session -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">

                    <i class="bi bi-check-circle-fill me-2"></i>
                    <strong>Berhasil!</strong>
                    {{ session('success') }}

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                            aria-label="Close">
                    </button>

                </div>
            @endif


            <!-- Error Session -->
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">

                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    {{ session('error') }}

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                            aria-label="Close">
                    </button>

                </div>
            @endif


            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">

                    <div class="fw-semibold mb-2">
                        <i class="bi bi-exclamation-circle-fill me-2"></i>
                        Terdapat kesalahan pada pengisian form:
                    </div>

                    <ul class="mb-0 ps-4">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                            aria-label="Close">
                    </button>

                </div>
            @endif


            <!-- Form -->
            <form action="{{ route('pengaduan.store') }}" method="POST">

                @csrf

                <div class="row gy-4">

                    <!-- Nama Pengadu -->
                    <div class="col-md-12">

                        <label for="nama_pengadu" class="form-label">
                            Nama Pengadu
                        </label>

                        <input
                            type="text"
                            name="nama_pengadu"
                            id="nama_pengadu"
                            class="form-control @error('nama_pengadu') is-invalid @enderror"
                            value="{{ old('nama_pengadu') }}"
                            placeholder="Masukkan nama lengkap Anda"
                            required
                        >

                        @error('nama_pengadu')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <!-- Jurusan -->
                    <div class="col-md-12">

                        <label for="jurusan_id" class="form-label">
                            Jurusan Pengadu
                        </label>

                        <select
                            name="jurusan_id"
                            id="jurusan_id"
                            class="form-select @error('jurusan_id') is-invalid @enderror"
                            required
                        >

                            <option value="" disabled
                                {{ old('jurusan_id') ? '' : 'selected' }}>
                                -- Pilih Jurusan --
                            </option>

                            @foreach($jurusans as $jurusan)

                                <option
                                    value="{{ $jurusan->id }}"
                                    {{ old('jurusan_id') == $jurusan->id ? 'selected' : '' }}
                                >
                                    {{ $jurusan->nama_jurusan }}
                                </option>

                            @endforeach

                        </select>

                        @error('jurusan_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <!-- Nama Dosen -->
                    <div class="col-md-12">

                        <label for="nama_dosen" class="form-label">
                            Nama Dosen Terkait
                        </label>

                        <input
                            type="text"
                            name="nama_dosen"
                            id="nama_dosen"
                            class="form-control @error('nama_dosen') is-invalid @enderror"
                            value="{{ old('nama_dosen') }}"
                            placeholder="Masukkan nama dosen yang bersangkutan"
                            required
                        >

                        @error('nama_dosen')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <!-- Isi Pengaduan -->
                    <div class="col-md-12">

                        <label for="isi_pengaduan" class="form-label">
                            Isi Pengaduan
                        </label>

                        <textarea
                            name="isi_pengaduan"
                            id="isi_pengaduan"
                            rows="7"
                            class="form-control @error('isi_pengaduan') is-invalid @enderror"
                            placeholder="Tuliskan detail pengaduan akademik Anda di sini..."
                            required
                        >{{ old('isi_pengaduan') }}</textarea>

                        @error('isi_pengaduan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                        <div class="form-text mt-2">
                            <i class="bi bi-info-circle me-1"></i>
                            Sampaikan pengaduan dengan bahasa yang sopan dan jelas.
                            Minimal 10 karakter.
                        </div>

                    </div>


                    <!-- Button -->
                    <div class="col-md-12 text-center">

                        <button
                            type="submit"
                            class="btn btn-primary px-4 py-3 rounded-pill shadow-sm"
                        >
                            <i class="bi bi-send me-2"></i>
                            Kirim Pengaduan
                        </button>

                        <div class="mt-3 text-muted small">
                            <i class="bi bi-shield-check me-1"></i>
                            Data pengaduan akan diproses secara aman.
                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

</section>

@endsection
