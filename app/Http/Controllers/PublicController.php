<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jurusan;
use App\Models\Pengaduan;
use App\Models\PengaduanHistory;
use App\Http\Requests\StorePengaduanRequest;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PublicController extends Controller
{
    public function beranda()
    {
        $title = 'Home';

        return view('public.beranda', compact('title'));
    }

    public function createPengaduan()
    {
        $jurusans = Jurusan::all();
        return view('public.buat-pengaduan', compact('jurusans'));
    }

    public function storePengaduan(StorePengaduanRequest $request)
    {
        DB::beginTransaction();
        try {
            // Generate Kode Pengaduan Otomatis: ADU-YYYYMMDD-XXXX
            $tanggal = Carbon::now()->format('Ymd');
            $latestPengaduan = Pengaduan::whereDate('created_at', Carbon::today())->latest('id')->first();

            if ($latestPengaduan) {
                $lastNumber = (int) substr($latestPengaduan->kode_pengaduan, -4);
                $nextNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
            } else {
                $nextNumber = '0001';
            }

            $kodePengaduan = "ADU-{$tanggal}-{$nextNumber}";

            $pengaduan = Pengaduan::create([
                'kode_pengaduan' => $kodePengaduan,
                'nama_pengadu' => $request->nama_pengadu,
                'jurusan_id' => $request->jurusan_id,
                'nama_dosen' => $request->nama_dosen,
                'isi_pengaduan' => $request->isi_pengaduan,
                'status' => 'Proses',
            ]);

            PengaduanHistory::create([
                'pengaduan_id' => $pengaduan->id,
                'user_id' => null,
                'status_sebelumnya' => '-',
                'status_baru' => 'Proses',
                'catatan' => 'Pengaduan berhasil dibuat oleh pengadu.',
            ]);

            DB::commit();

            return redirect()->route('pengaduan.create')
                ->with('success', "Pengaduan berhasil dikirim! Kode Pengaduan Anda: {$kodePengaduan}. Silakan simpan kode ini untuk pengecekan.");

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Terjadi kesalahan sistem. Silakan coba lagi.');
        }
    }

public function antrian(Request $request)
{
    $query = Pengaduan::with('jurusan');

    // Filter berdasarkan Jurusan
    if ($request->filled('jurusan_id')) {
        $query->where('jurusan_id', $request->jurusan_id);
    }

    // Filter pencarian berdasarkan Kode Pengaduan
    if ($request->filled('search')) {
        $query->where(
            'kode_pengaduan',
            'like',
            '%' . $request->search . '%'
        );
    }

    // Total Data per Status
    $prosesTotal = (clone $query)
        ->where('status', 'Proses')
        ->count();

    $sedangDitanganiTotal = (clone $query)
        ->where('status', 'Sedang Ditangani')
        ->count();

    $selesaiTotal = (clone $query)
        ->where('status', 'Selesai')
        ->count();

    // Tampilkan hanya 5 data terbaru
    $proses = (clone $query)
        ->where('status', 'Proses')
        ->latest()
        ->take(5)
        ->get();

    $sedangDitangani = (clone $query)
        ->where('status', 'Sedang Ditangani')
        ->latest()
        ->take(5)
        ->get();

    $selesai = (clone $query)
        ->where('status', 'Selesai')
        ->latest()
        ->take(5)
        ->get();

    $jurusans = Jurusan::all();

    return view('public.antrian', compact(
        'proses',
        'sedangDitangani',
        'selesai',
        'prosesTotal',
        'sedangDitanganiTotal',
        'selesaiTotal',
        'jurusans'
    ));
}


    public function tentang()
    {
        // return view('public.tentang');
    }
}
