<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Jurusan;
use App\Models\PengaduanHistory;
use Illuminate\Support\Facades\DB;

class AdminPengaduanController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Daftar Pengaduan';

        $user = auth()->user();
        $query = Pengaduan::with('jurusan');

        // Batasi query jika role adalah admin jurusan (Bukan super_admin)
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

        // Filter tanggal
        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $query->whereBetween('created_at', [$request->tanggal_mulai . ' 00:00:00', $request->tanggal_selesai . ' 23:59:59']);
        }

        // Search kode / nama pengadu
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('kode_pengaduan', 'like', "%{$search}%")
                  ->orWhere('nama_pengadu', 'like', "%{$search}%");
            });
        }

        $pengaduans = $query->latest()->paginate(10)->withQueryString();
        $jurusans = Jurusan::all();

        return view('admin.pengaduan.index', compact('pengaduans', 'jurusans', 'title'));
    }

    public function show($id)
    {
        $title = 'Detail Pengaduan';

        $user = auth()->user();
        $pengaduan = Pengaduan::with(['jurusan', 'histories.user'])->findOrFail($id);

        // PROTEKSI IDOR KETAT: Jika admin jurusan mencoba mengakses pengaduan jurusan lain, tolak!
        if ($user->role === 'admin' && $pengaduan->jurusan_id !== $user->jurusan_id) {
            abort(403, 'Akses ditolak. Anda tidak berhak melihat pengaduan jurusan lain.');
        }

        return view('admin.pengaduan.show', compact('pengaduan', compact('title')));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => ['required', 'in:Proses,Sedang Ditangani,Selesai'],
            'catatan' => ['nullable', 'string', 'max:1000'],
        ]);

        $user = auth()->user();
        $pengaduan = Pengaduan::findOrFail($id);

        // PROTEKSI IDOR KETAT PADA UPDATE
        if ($user->role === 'admin' && $pengaduan->jurusan_id !== $user->jurusan_id) {
            abort(403, 'Akses ditolak. Anda tidak berhak mengubah pengaduan jurusan lain.');
        }

        $statusSebelumnya = $pengaduan->status;
        $statusBaru = $request->status;

        if ($statusSebelumnya === $statusBaru && empty($request->catatan)) {
            return back()->with('error', 'Tidak ada perubahan status atau catatan yang diberikan.');
        }

        DB::beginTransaction();
        try {
            // Update status pengaduan
            $pengaduan->update([
                'status' => $statusBaru,
            ]);

            // Catat history
            PengaduanHistory::create([
                'pengaduan_id' => $pengaduan->id,
                'user_id' => $user->id,
                'status_sebelumnya' => $statusSebelumnya,
                'status_baru' => $statusBaru,
                'catatan' => $request->catatan ?? 'Status pengaduan diperbarui oleh ' . $user->name,
            ]);

            DB::commit();

            return redirect()->route('admin.pengaduan.show', $pengaduan->id)
                ->with('success', 'Status pengaduan berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat memperbarui status.');
        }
    }
}
