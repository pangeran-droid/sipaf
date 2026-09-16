<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Jurusan;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $tahunIni = Carbon::now()->year;

        /* Super Admin */
        if ($user->role === 'super_admin') {

            $totalPengaduan = Pengaduan::count();
            $proses = Pengaduan::where('status', 'Proses')->count();
            $sedangDitangani = Pengaduan::where('status', 'Sedang Ditangani')->count();
            $selesai = Pengaduan::where('status', 'Selesai')->count();
            $jurusans = Jurusan::withCount('pengaduans')->get();
            $pengaduanTerbaru = Pengaduan::with('jurusan')
                ->latest()
                ->take(5)
                ->get();

            $pengaduanPerBulan = [];

            for ($bulan = 1; $bulan <= 12; $bulan++) {
                $pengaduanPerBulan[] = Pengaduan::whereYear(
                    'created_at',
                    $tahunIni
                )
                ->whereMonth('created_at', $bulan)
                ->count();
            }

            $chartPengaduan = [
                'labels' => [
                    'Jan', 'Feb', 'Mar', 'Apr',
                    'Mei', 'Jun', 'Jul', 'Ags',
                    'Sep', 'Okt', 'Nov', 'Des'
                ],
                'data' => $pengaduanPerBulan,
            ];
            $chartJurusan = [
                'labels' => $jurusans->pluck('nama_jurusan')->values(),
                'data' => $jurusans->pluck('pengaduans_count')->values(),
            ];

            return view('admin.dashboard', compact(
                'totalPengaduan',
                'proses',
                'sedangDitangani',
                'selesai',
                'jurusans',
                'pengaduanTerbaru',
                'pengaduanPerBulan',
                'chartPengaduan',
                'chartJurusan',
                'tahunIni'
            ));
        }

        /* Admin Jurusan */
        $jurusanId = $user->jurusan_id;
        $query = Pengaduan::where('jurusan_id', $jurusanId);
        $totalPengaduan = (clone $query)->count();
        $proses = (clone $query)
            ->where('status', 'Proses')
            ->count();
        $sedangDitangani = (clone $query)
            ->where('status', 'Sedang Ditangani')
            ->count();
        $selesai = (clone $query)
            ->where('status', 'Selesai')
            ->count();
        $pengaduanTerbaru = (clone $query)
            ->with('jurusan')
            ->latest()
            ->take(5)
            ->get();

        $pengaduanPerBulan = [];

        for ($bulan = 1; $bulan <= 12; $bulan++) {
            $pengaduanPerBulan[] = (clone $query)
                ->whereYear('created_at', $tahunIni)
                ->whereMonth('created_at', $bulan)
                ->count();
        }

        $chartPengaduan = [
            'labels' => [
                'Jan', 'Feb', 'Mar', 'Apr',
                'Mei', 'Jun', 'Jul', 'Ags',
                'Sep', 'Okt', 'Nov', 'Des'
            ],
            'data' => $pengaduanPerBulan,
        ];

        return view('admin.dashboard', compact(
            'totalPengaduan',
            'proses',
            'sedangDitangani',
            'selesai',
            'pengaduanTerbaru',
            'pengaduanPerBulan',
            'chartPengaduan',
            'tahunIni'
        ));
    }
}
