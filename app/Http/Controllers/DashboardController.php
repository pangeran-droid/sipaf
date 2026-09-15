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

        /*
        |--------------------------------------------------------------------------
        | SUPER ADMIN
        |--------------------------------------------------------------------------
        */
        if ($user->role === 'super_admin') {

            // Statistik utama
            $totalPengaduan = Pengaduan::count();

            $proses = Pengaduan::where('status', 'Proses')->count();

            $sedangDitangani = Pengaduan::where('status', 'Sedang Ditangani')->count();

            $selesai = Pengaduan::where('status', 'Selesai')->count();


            // Statistik pengaduan per jurusan
            $jurusans = Jurusan::withCount('pengaduans')->get();


            // Pengaduan terbaru
            $pengaduanTerbaru = Pengaduan::with('jurusan')
                ->latest()
                ->take(5)
                ->get();


            // Statistik pengaduan per bulan
            $pengaduanPerBulan = [];

            for ($bulan = 1; $bulan <= 12; $bulan++) {
                $pengaduanPerBulan[] = Pengaduan::whereYear(
                    'created_at',
                    $tahunIni
                )
                ->whereMonth('created_at', $bulan)
                ->count();
            }


            // Data untuk ApexCharts
            $chartPengaduan = [
                'labels' => [
                    'Jan', 'Feb', 'Mar', 'Apr',
                    'Mei', 'Jun', 'Jul', 'Ags',
                    'Sep', 'Okt', 'Nov', 'Des'
                ],
                'data' => $pengaduanPerBulan,
            ];


            // Data chart jurusan
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


        /*
        |--------------------------------------------------------------------------
        | ADMIN JURUSAN
        |--------------------------------------------------------------------------
        */

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


        // Pengaduan terbaru jurusan
        $pengaduanTerbaru = (clone $query)
            ->with('jurusan')
            ->latest()
            ->take(5)
            ->get();


        // Statistik bulanan admin jurusan
        $pengaduanPerBulan = [];

        for ($bulan = 1; $bulan <= 12; $bulan++) {
            $pengaduanPerBulan[] = (clone $query)
                ->whereYear('created_at', $tahunIni)
                ->whereMonth('created_at', $bulan)
                ->count();
        }


        // Chart untuk admin jurusan
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
