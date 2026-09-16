<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jurusan;

class JurusanManagementController extends Controller
{
    public function index()
    {
        $title= 'Daftar Hurusan';

        $jurusans = Jurusan::withCount(['users', 'pengaduans'])->latest()->paginate(10);
        return view('admin.jurusan.index', compact('jurusans', 'title'));
    }

    public function create()
    {
        return view('admin.jurusan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jurusan' => ['required', 'string', 'max:255', 'unique:jurusans'],
        ]);

        Jurusan::create([
            'nama_jurusan' => $request->nama_jurusan,
        ]);

        return redirect()->route('admin.jurusan.index')
            ->with('success', 'Data jurusan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        return view('admin.jurusan.edit', compact('jurusan'));
    }

    public function update(Request $request, $id)
    {
        $jurusan = Jurusan::findOrFail($id);

        $request->validate([
            'nama_jurusan' => ['required', 'string', 'max:255', 'unique:jurusans,nama_jurusan,' . $jurusan->id],
        ]);

        $jurusan->update([
            'nama_jurusan' => $request->nama_jurusan,
        ]);

        return redirect()->route('admin.jurusan.index')
            ->with('success', 'Data jurusan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jurusan = Jurusan::withCount(['users', 'pengaduans'])->findOrFail($id);

        // Proteksi agar jurusan tidak dapat dihapus jika masih terikat dengan user atau pengaduan
        if ($jurusan->users_count > 0 || $jurusan->pengaduans_count > 0) {
            return back()->with('error', 'Jurusan tidak dapat dihapus karena masih terikat dengan akun admin atau data pengaduan aktif.');
        }

        $jurusan->delete();

        return redirect()->route('admin.jurusan.index')
            ->with('success', 'Data jurusan berhasil dihapus.');
    }
}
