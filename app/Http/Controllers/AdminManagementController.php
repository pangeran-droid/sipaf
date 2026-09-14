<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Jurusan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminManagementController extends Controller
{
    public function index()
    {
        $admins = User::with('jurusan')->latest()->paginate(10);
        return view('admin.manajemen-admin.index', compact('admins'));
    }

    public function create()
    {
        $jurusans = Jurusan::all();
        return view('admin.manajemen-admin.create', compact('jurusans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'in:super_admin,admin'],
            'jurusan_id' => [
                'nullable',
                Rule::requiredIf(fn () => $request->role === 'admin'),
                'exists:jurusans,id'
            ],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'jurusan_id' => $request->role === 'super_admin' ? null : $request->jurusan_id,
        ]);

        return redirect()->route('admin.manajemen-admin.index')
            ->with('success', 'Akun admin berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $admin = User::findOrFail($id);
        $jurusans = Jurusan::all();
        return view('admin.manajemen-admin.edit', compact('admin', 'jurusans'));
    }

    public function update(Request $request, $id)
    {
        $admin = User::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($admin->id)],
            'password' => ['nullable', 'string', 'min:8'],
            'role' => ['required', 'in:super_admin,admin'],
            'jurusan_id' => [
                'nullable',
                Rule::requiredIf(fn () => $request->role === 'admin'),
                'exists:jurusans,id'
            ],
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'jurusan_id' => $request->role === 'super_admin' ? null : $request->jurusan_id,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $admin->update($data);

        return redirect()->route('admin.manajemen-admin.index')
            ->with('success', 'Akun admin berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $admin = User::findOrFail($id);

        if ($admin->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri yang sedang aktif.');
        }

        $admin->delete();

        return redirect()->route('admin.manajemen-admin.index')
            ->with('success', 'Akun admin berhasil dihapus.');
    }
}