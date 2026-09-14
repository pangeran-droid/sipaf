@extends('layouts.admin', ['title' => 'Kelola Jurusan - SIPAF Admin'])

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2 fw-bold">Manajemen Data Jurusan</h1>
    <a href="{{ route('admin.jurusan.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i>Tambah Jurusan</a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="py-3 ps-3">No</th>
                        <th class="py-3">Nama Jurusan</th>
                        <th class="py-3">Jumlah Admin Terikat</th>
                        <th class="py-3">Jumlah Pengaduan</th>
                        <th class="py-3 text-end pe-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jurusans as $index => $jurusan)
                        <tr>
                            <td class="ps-3">{{ $jurusans->firstItem() + $index }}</td>
                            <td class="fw-bold">{{ $jurusan->nama_jurusan }}</td>
                            <td><span class="badge bg-info text-dark">{{ $jurusan->users_count }} Admin</span></td>
                            <td><span class="badge bg-secondary">{{ $jurusan->pengaduans_count }} Pengaduan</span></td>
                            <td class="text-end pe-3">
                                <a href="{{ route('admin.jurusan.edit', $jurusan->id) }}" class="btn btn-sm btn-outline-warning">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('admin.jurusan.destroy', $jurusan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus jurusan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Belum ada data jurusan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white py-3">
        {{ $jurusans->links() }}
    </div>
</div>
@endsection