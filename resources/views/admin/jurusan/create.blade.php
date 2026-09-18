@extends('layouts.admin')

@section('content')

<!-- [ breadcrumb ] start -->
<div class="page-header">
    <div class="page-block">

        <div class="flex items-center justify-between flex-wrap gap-4 py-3">

            <div class="page-header-title">

                <h2 class="mb-1 text-xl font-bold text-gray-800 dark:text-white">
                    Tambah Jurusan Baru
                </h2>

                <p class="text-muted mb-0">
                    Tambahkan jurusan baru ke dalam sistem.
                </p>

            </div>

            <a
                href="{{ route('admin.jurusan.index') }}"
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

            <div class="card-header">

                <div class="d-flex align-items-center">

                    <div class="avtar avtar-s bg-light-primary me-3">

                        <i class="ti ti-building-community text-primary f-20"></i>

                    </div>

                    <div>

                        <h5 class="mb-1">
                            Informasi Jurusan
                        </h5>

                        <p class="text-muted mb-0 f-12">
                            Masukkan nama jurusan yang akan ditambahkan.
                        </p>

                    </div>

                </div>

            </div>


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

                                        <li>
                                            {{ $error }}
                                        </li>

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
                    action="{{ route('admin.jurusan.store') }}"
                    method="POST">

                    @csrf


                    <div class="mb-4">

                        <label
                            for="nama_jurusan"
                            class="form-label">

                            Nama Jurusan
                            <span class="text-danger">*</span>

                        </label>

                        <div class="input-group">

                            <span class="input-group-text">

                                <i class="ti ti-building-community"></i>

                            </span>

                            <input
                                type="text"
                                class="form-control"
                                id="nama_jurusan"
                                name="nama_jurusan"
                                value="{{ old('nama_jurusan') }}"
                                placeholder="Contoh: Teknik Industri"
                                required>

                        </div>

                        <small class="text-muted">
                            Masukkan nama jurusan sesuai dengan nama resmi yang digunakan.
                        </small>

                    </div>


                    <hr class="my-4">


                    <div class="d-flex justify-content-end gap-2">

                        <a
                            href="{{ route('admin.jurusan.index') }}"
                            class="btn btn-light-secondary">

                            <i class="ti ti-x me-1"></i>
                            Batal

                        </a>

                        <button
                            type="submit"
                            class="btn btn-primary">

                            <i class="ti ti-device-floppy me-1"></i>
                            Simpan Jurusan

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>


@endsection
