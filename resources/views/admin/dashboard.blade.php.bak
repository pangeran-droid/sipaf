@extends('layouts.admin', ['title' => 'Dashboard - SIPAF Admin'])

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2 fw-bold">Dashboard {{ auth()->user()->role === 'super_admin' ? 'Super Admin' : 'Admin ' . auth()->user()->jurusan->nama_jurusan }}</h1>
    <span class="text-muted">Selamat datang kembali, {{ auth()->user()->name }}!</span>
</div>

<!-- Statistik Cards -->
<div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm bg-primary text-white h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase fw-semibold mb-1">Total Pengaduan</h6>
                        <h2 class="display-6 fw-bold mb-0">{{ $totalPengaduan }}</h2>
                    </div>
                    <div class="fs-1 text-white-50"><i class="bi bi-chat-square-text"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm bg-info text-white h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase fw-semibold mb-1">Proses</h6>
                        <h2 class="display-6 fw-bold mb-0">{{ $proses }}</h2>
                    </div>
                    <div class="fs-1 text-white-50"><i class="bi bi-hourglass-split"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm bg-warning text-dark h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase fw-semibold mb-1">Sedang Ditangani</h6>
                        <h2 class="display-6 fw-bold mb-0">{{ $sedangDitangani }}</h2>
                    </div>
                    <div class="fs-1 text-dark opacity-50"><i class="bi bi-gear-fill"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm bg-success text-white h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase fw-semibold mb-1">Selesai</h6>
                        <h2 class="display-6 fw-bold mb-0">{{ $selesai }}</h2>
                    </div>
                    <div class="fs-1 text-white-50"><i class="bi bi-check-circle-fill"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(auth()->user()->role === 'super_admin')
<!-- Grafik & Statistik Jurusan (Super Admin Only) -->
<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3">
                <h5 class="card-title fw-bold mb-0"><i class="bi bi-bar-chart-line me-2"></i>Grafik Pengaduan Per Bulan ({{ date('Y') }})</h5>
            </div>
            <div class="card-body">
                <canvas id="chartPengaduan" height="120"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3">
                <h5 class="card-title fw-bold mb-0"><i class="bi bi-pie-chart me-2"></i>Pengaduan Berdasarkan Jurusan</h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @foreach($jurusans as $jurusan)
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            {{ $jurusan->nama_jurusan }}
                            <span class="badge bg-primary rounded-pill">{{ $jurusan->pengaduans_count }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Pengaduan Terbaru -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white py-3">
        <h5 class="card-title fw-bold mb-0"><i class="bi bi-clock-history me-2"></i>Pengaduan Terbaru</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="py-3 ps-3">Kode</th>
                        <th class="py-3">Nama Pengadu</th>
                        <th class="py-3">Jurusan</th>
                        <th class="py-3">Dosen Terkait</th>
                        <th class="py-3">Status</th>
                        <th class="py-3 pe-3">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengaduanTerbaru as $item)
                        <tr>
                            <td class="ps-3 fw-bold text-primary">{{ $item->kode_pengaduan }}</td>
                            <td>{{ $item->nama_pengadu }}</td>
                            <td>{{ $item->jurusan->nama_jurusan }}</td>
                            <td>{{ $item->nama_dosen }}</td>
                            <td>
                                @if($item->status === 'Proses')
                                    <span class="badge bg-info text-dark">Proses</span>
                                @elseif($item->status === 'Sedang Ditangani')
                                    <span class="badge bg-warning text-dark">Sedang Ditangani</span>
                                @else
                                    <span class="badge bg-success">Selesai</span>
                                @endif
                            </td>
                            <td class="pe-3 text-muted small">{{ $item->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Belum ada data pengaduan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@if(auth()->user()->role === 'super_admin')
<script>
    const ctx = document.getElementById('chartPengaduan').getContext('2d');
    const chartPengaduan = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Jumlah Pengaduan',
                data: @json($pengaduanPerBulan),
                backgroundColor: 'rgba(13, 110, 25, 0.7)',
                borderColor: 'rgba(13, 110, 253, 1)',
                borderWidth: 1,
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>
@endif
@endpush