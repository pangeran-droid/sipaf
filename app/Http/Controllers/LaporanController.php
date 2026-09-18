<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Jurusan;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Laporan Pengaduan';

        $tahunIni = Carbon::Now()->year;
        $user = auth()->user();
        $query = Pengaduan::with('jurusan');

        // Batasi query jika role adalah admin jurusan
        if ($user->role === 'admin') {
            $query->where('jurusan_id', $user->jurusan_id);
        } else {
            // Super Admin dapat memfilter berdasarkan jurusan
            if ($request->filled('jurusan_id')) {
                $query->where('jurusan_id', $request->jurusan_id);
            }
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter rentang tanggal
        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $query->whereBetween('created_at', [
                $request->tanggal_mulai . ' 00:00:00',
                $request->tanggal_selesai . ' 23:59:59'
            ]);
        }

        $pengaduans = $query->latest()->get();
        $jurusans = Jurusan::all();

        // Statistik ringkas laporan
        $totalLaporan = $pengaduans->count();
        $totalProses = $pengaduans->where('status', 'Proses')->count();
        $totalDitangani = $pengaduans->where('status', 'Sedang Ditangani')->count();
        $totalSelesai = $pengaduans->where('status', 'Selesai')->count();

        return view('admin.laporan.index', compact(
            'pengaduans',
            'jurusans',
            'totalLaporan',
            'totalProses',
            'totalDitangani',
            'totalSelesai',
            'tahunIni',
            'title'
        ));
    }
}
