@extends('layouts.admin')

@section('content')

    <!-- Header dashboard -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-xl font-semibold mb-1">
                Dashboard
            </h2>

            <p class="text-muted mb-0">
                Ringkasan pengaduan tahun {{ $tahunIni }}
            </p>
        </div>
    </div>

    <!-- Info user -->
    <div class="grid grid-cols-12 gap-x-6 mt-5" id="welcome-card-wrapper">

        <div class="col-span-12">
            <div class="card">

                <div class="card-body">

                    <div class="flex items-center">

                        <!-- Icon -->
                        <div class="shrink-0">
                            <div class="w-12 h-12 rounded-xl inline-flex items-center justify-center bg-primary-500/10 text-primary-500">
                                <i class="ti ti-user text-2xl"></i>
                            </div>
                        </div>


                        <!-- User Information -->
                        <div class="grow ltr:ml-4 rtl:mr-4">

                            <h5 class="mb-1">
                                Selamat datang, {{ auth()->user()->name }}
                            </h5>

                            <p class="text-muted mb-0">
                                Anda login sebagai
                                <strong>
                                    @if(auth()->user()->role === 'super_admin')
                                        Super Admin
                                    @else
                                        Admin Jurusan
                                    @endif
                                </strong>.
                            </p>

                        </div>


                        <!-- Close Button -->
                        <div class="shrink-0 self-start">

                            <button
                                type="button"
                                id="close-welcome-card"
                                class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary hover:bg-theme-bodybg dark:hover:bg-themedark-bodybg"
                                aria-label="Tutup"
                                title="Tutup"
                            >
                                <i class="ti ti-x text-lg leading-none"></i>
                            </button>

                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>

    <!-- Statistik utamam -->
    <div class="grid grid-cols-12 gap-x-6">

        <!-- Total Pengaduan -->
        <div class="col-span-12 md:col-span-6 2xl:col-span-3">
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">

                        <div class="shrink-0">
                            <div class="w-10 h-10 rounded-xl inline-flex items-center justify-center bg-primary-500/10 text-primary-500">
                                <i class="ti ti-message-report text-2xl"></i>
                            </div>
                        </div>

                        <div class="grow ltr:ml-3 rtl:mr-3">
                            <h6 class="mb-1">Total Pengaduan</h6>
                            <h4 class="mb-0">{{ number_format($totalPengaduan) }}</h4>
                        </div>

                    </div>

                    <div class="mt-4">
                        <p class="text-muted mb-0">
                            <i class="ti ti-chart-bar"></i>
                            Seluruh pengaduan
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Proses -->
        <div class="col-span-12 md:col-span-6 2xl:col-span-3">
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">

                        <div class="shrink-0">
                            <div class="w-10 h-10 rounded-xl inline-flex items-center justify-center bg-warning-500/10 text-warning-500">
                                <i class="ti ti-clock text-2xl"></i>
                            </div>
                        </div>

                        <div class="grow ltr:ml-3 rtl:mr-3">
                            <h6 class="mb-1">Proses</h6>
                            <h4 class="mb-0">{{ number_format($proses) }}</h4>
                        </div>

                    </div>

                    <div class="mt-4">
                        <p class="text-warning-500 mb-0">
                            <i class="ti ti-loader"></i>
                            Sedang diproses
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sedang Ditangani -->
        <div class="col-span-12 md:col-span-6 2xl:col-span-3">
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">

                        <div class="shrink-0">
                            <div class="w-10 h-10 rounded-xl inline-flex items-center justify-center bg-info-500/10 text-info-500">
                                <i class="ti ti-user-search text-2xl"></i>
                            </div>
                        </div>

                        <div class="grow ltr:ml-3 rtl:mr-3">
                            <h6 class="mb-1">Sedang Ditangani</h6>
                            <h4 class="mb-0">{{ number_format($sedangDitangani) }}</h4>
                        </div>

                    </div>

                    <div class="mt-4">
                        <p class="text-info-500 mb-0">
                            <i class="ti ti-progress"></i>
                            Dalam penanganan
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Selesai -->
        <div class="col-span-12 md:col-span-6 2xl:col-span-3">
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">

                        <div class="shrink-0">
                            <div class="w-10 h-10 rounded-xl inline-flex items-center justify-center bg-success-500/10 text-success-500">
                                <i class="ti ti-circle-check text-2xl"></i>
                            </div>
                        </div>

                        <div class="grow ltr:ml-3 rtl:mr-3">
                            <h6 class="mb-1">Selesai</h6>
                            <h4 class="mb-0">{{ number_format($selesai) }}</h4>
                        </div>

                    </div>

                    <div class="mt-4">
                        <p class="text-success-500 mb-0">
                            <i class="ti ti-check"></i>
                            Pengaduan terselesaikan
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik pengaduan bulanan -->
        <div class="col-span-12 lg:col-span-8">
            <div class="card">
                <div class="card-body">

                    <div class="flex items-center justify-between mb-3">
                        <div>
                            <h5 class="mb-1">Pengaduan Bulanan</h5>
                            <p class="text-muted mb-0">
                                Statistik pengaduan tahun {{ $tahunIni }}
                            </p>
                        </div>
                    </div>

                    <div id="pengaduan-bulanan-chart"></div>

                </div>
            </div>
        </div>

        <!-- Ringkasan status -->
        <div class="col-span-12 lg:col-span-6">
            <div class="card">
                <div class="card-body">

                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h5 class="mb-1">Status Pengaduan</h5>
                            <p class="text-muted mb-0">Distribusi status</p>
                        </div>
                    </div>

                    <div id="status-pengaduan-chart"></div><br>

                    <!-- Status Horizontal -->
                    <div class="flex items-center justify-between gap-4 mt-4">

                        <!-- Proses -->
                        <div class="flex-1 text-center">
                            <div class="flex items-center justify-center gap-2 mb-1">
                                <span class="w-2.5 h-2.5 rounded-full bg-warning-500 inline-block"></span>
                                <p class="text-muted mb-0 text-sm">Proses</p>
                            </div>
                            <h6 class="mb-0">{{ $proses }}</h6>
                        </div>

                        <!-- Ditangani -->
                        <div class="flex-1 text-center">
                            <div class="flex items-center justify-center gap-2 mb-1">
                                <span class="w-2.5 h-2.5 rounded-full bg-info-500 inline-block"></span>
                                <p class="text-muted mb-0 text-sm">Ditangani</p>
                            </div>
                            <h6 class="mb-0">{{ $sedangDitangani }}</h6>
                        </div>

                        <!-- Selesai -->
                        <div class="flex-1 text-center">
                            <div class="flex items-center justify-center gap-2 mb-1">
                                <span class="w-2.5 h-2.5 rounded-full bg-success-500 inline-block"></span>
                                <p class="text-muted mb-0 text-sm">Selesai</p>
                            </div>
                            <h6 class="mb-0">{{ $selesai }}</h6>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <!-- Pengaduan terbaru -->
        <div class="col-span-12 lg:col-span-6">
            <div class="card">

                <div class="card-header">
                    <div class="flex items-center justify-between">
                        <div>
                            <h5 class="mb-1">Pengaduan Terbaru</h5>
                            <p class="text-muted mb-0">
                                5 pengaduan terakhir
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0">

                    @forelse($pengaduanTerbaru as $pengaduan)

                        <div class="flex items-center px-5 py-4 border-b border-theme-border dark:border-themedark-border">

                            <div class="shrink-0">
                                <div class="w-10 h-10 rounded-xl inline-flex items-center justify-center bg-primary-500/10 text-primary-500">
                                    <i class="ti ti-message text-xl"></i>
                                </div>
                            </div>

                            <div class="grow ltr:ml-3 rtl:mr-3 min-w-0">

                                <h6 class="mb-1 truncate">
                                    {{ $pengaduan->judul ?? 'Pengaduan' }}
                                </h6>

                                <p class="text-muted mb-0 text-sm">
                                    {{ $pengaduan->jurusan->nama_jurusan ?? '-' }}
                                </p>

                            </div>

                            <div class="shrink-0 text-right">

                                @if($pengaduan->status === 'Proses')

                                    <span class="badge bg-warning-500 text-white">
                                        Proses
                                    </span>

                                @elseif($pengaduan->status === 'Sedang Ditangani')

                                    <span class="badge bg-info-500 text-white">
                                        Ditangani
                                    </span>

                                @elseif($pengaduan->status === 'Selesai')

                                    <span class="badge bg-success-500 text-white">
                                        Selesai
                                    </span>

                                @else

                                    <span class="badge bg-secondary-500 text-white">
                                        {{ $pengaduan->status }}
                                    </span>

                                @endif

                                <p class="text-muted mb-0 mt-1 text-xs">
                                    {{ $pengaduan->created_at?->format('d M Y H:i') }}
                                </p>

                            </div>

                        </div>

                    @empty

                        <div class="text-center py-10">
                            <i class="ti ti-inbox text-4xl text-muted"></i>
                            <p class="text-muted mt-3 mb-0">
                                Belum ada pengaduan.
                            </p>
                        </div>

                    @endforelse

                </div>

            </div>
        </div>

        <!-- Statistik per jurusan -->
        @if(auth()->user()->role === 'super_admin' && isset($jurusans))
            <div class="col-span-12 lg:col-span-5">
                <div class="card">

                    <div class="card-header">
                        <h5 class="mb-1">Pengaduan per Jurusan</h5>
                        <p class="text-muted mb-0">
                            Distribusi pengaduan berdasarkan jurusan
                        </p>
                    </div>

                    <div class="card-body">

                        <div id="jurusan-pengaduan-chart"></div>

                    </div>

                </div>
            </div>
        @endif

    </div>

@endsection

@push('scripts')

    <!-- ApexCharts -->
    <script src="{{ asset('templates/backend/js/plugins/apexcharts.min.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            /* Welcome card */
            const welcomeCard = document.getElementById('welcome-card-wrapper');
            const closeButton = document.getElementById('close-welcome-card');

            if (welcomeCard && closeButton) {

                closeButton.addEventListener('click', function () {
                    welcomeCard.style.display = 'none';
                });

            }

            /* Data dari controller */
            const chartPengaduan = @json($chartPengaduan);

            const totalPengaduan = {{ $totalPengaduan }};
            const proses = {{ $proses }};
            const sedangDitangani = {{ $sedangDitangani }};
            const selesai = {{ $selesai }};


            /* Chart pengaduan bulanan */
            const monthlyElement = document.querySelector(
                '#pengaduan-bulanan-chart'
            );

            if (monthlyElement) {

                const monthlyChart = new ApexCharts(
                    monthlyElement,
                    {
                        chart: {
                            type: 'area',
                            height: 330,
                            toolbar: {
                                show: false
                            }
                        },

                        colors: ['#4680FF'],

                        stroke: {
                            curve: 'smooth',
                            width: 3
                        },

                        fill: {
                            type: 'gradient',
                            gradient: {
                                shadeIntensity: 1,
                                opacityFrom: 0.35,
                                opacityTo: 0.05,
                                stops: [0, 100]
                            }
                        },

                        series: [
                            {
                                name: 'Pengaduan',
                                data: chartPengaduan.data
                            }
                        ],

                        xaxis: {
                            categories: chartPengaduan.labels
                        },

                        yaxis: {
                            min: 0,
                            forceNiceScale: true,
                            labels: {
                                formatter: function (value) {
                                    return Math.round(value);
                                }
                            }
                        },

                        dataLabels: {
                            enabled: false
                        },

                        grid: {
                            borderColor: '#e5e7eb',
                            strokeDashArray: 4
                        },

                        tooltip: {
                            y: {
                                formatter: function (value) {
                                    return value + ' pengaduan';
                                }
                            }
                        }
                    }
                );

                monthlyChart.render();
            }


            /* Chart status pengaduan */
            const statusElement = document.querySelector(
                '#status-pengaduan-chart'
            );

            if (statusElement) {

                const statusChart = new ApexCharts(
                    statusElement,
                    {
                        chart: {
                            type: 'donut',
                            height: 280
                        },

                        series: [
                            proses,
                            sedangDitangani,
                            selesai
                        ],

                        labels: [
                            'Proses',
                            'Sedang Ditangani',
                            'Selesai'
                        ],

                        colors: [
                            '#E58A00',
                            '#00A9F4',
                            '#2ca87f'
                        ],

                        legend: {
                            show: false
                        },

                        dataLabels: {
                            enabled: true
                        },

                        plotOptions: {
                            pie: {
                                donut: {
                                    size: '70%',
                                    labels: {
                                        show: true,

                                        total: {
                                            show: true,
                                            label: 'Total',
                                            formatter: function () {
                                                return totalPengaduan;
                                            }
                                        }
                                    }
                                }
                            }
                        },

                        tooltip: {
                            y: {
                                formatter: function (value) {
                                    return value + ' pengaduan';
                                }
                            }
                        }
                    }
                );

                statusChart.render();
            }


            /* Chart per jurusan untuk super admin */
            const jurusanElement = document.querySelector(
                '#jurusan-pengaduan-chart'
            );

            @if(auth()->user()->role === 'super_admin' && isset($chartJurusan))

                if (jurusanElement) {

                    const chartJurusan = @json($chartJurusan);

                    const jurusanChart = new ApexCharts(
                        jurusanElement,
                        {
                            chart: {
                                type: 'bar',
                                height: 300,
                                toolbar: {
                                    show: false
                                }
                            },

                            series: [
                                {
                                    name: 'Pengaduan',
                                    data: chartJurusan.data
                                }
                            ],

                            xaxis: {
                                categories: chartJurusan.labels
                            },

                            colors: ['#4680FF'],

                            plotOptions: {
                                bar: {
                                    borderRadius: 5,
                                    columnWidth: '45%'
                                }
                            },

                            dataLabels: {
                                enabled: false
                            },

                            grid: {
                                borderColor: '#e5e7eb',
                                strokeDashArray: 4
                            },

                            tooltip: {
                                y: {
                                    formatter: function (value) {
                                        return value + ' pengaduan';
                                    }
                                }
                            }
                        }
                    );

                    jurusanChart.render();
                }

            @endif

        });
    </script>

@endpush
