@extends('layouts.admin')

@section('content')

<!-- [ breadcrumb ] start -->
<div class="page-header">
    <div class="page-block">
        <div class="flex items-center justify-between flex-wrap gap-4 py-3">
            <div class="page-header-title">
                <h2 class="mb-0 text-xl font-bold text-gray-800 dark:text-white">Manajemen Akun Admin</h2>
            </div>
            <a href="{{ route('admin.manajemen-admin.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i>Tambah Admin</a>
        </div>
    </div>
</div>
<!-- [ breadcrumb ] end -->

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
                        <th class="py-3 ps-3">Nama</th>
                        <th class="py-3">Email</th>
                        <th class="py-3">Role</th>
                        <th class="py-3">Jurusan</th>
                        <th class="py-3 text-end pe-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($admins as $admin)
                        <tr>
                            <td class="ps-3 fw-bold">{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>
                                @if($admin->role === 'super_admin')
                                    <span class="badge bg-danger">Super Admin</span>
                                @else
                                    <span class="badge bg-primary">Admin Jurusan</span>
                                @endif
                            </td>
                            <td>{{ $admin->jurusan ? $admin->jurusan->nama_jurusan : '-' }}</td>
                            <td class="text-end pe-3">
                                <a href="{{ route('admin.manajemen-admin.edit', $admin->id) }}" class="btn btn-sm btn-outline-warning">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                @if($admin->id !== auth()->id())
                                    <form action="{{ route('admin.manajemen-admin.destroy', $admin->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus admin ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Belum ada data admin.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white py-3">
        {{ $admins->links() }}
    </div>
</div>
@endsection
