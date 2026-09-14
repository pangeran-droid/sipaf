<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Jurusan;
use App\Models\Pengaduan;

class PengaduanSecurityTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_jurusan_hanya_dapat_melihat_pengaduan_jurusannya_sendiri()
    {
        // Buat Jurusan
        $jurusanIf = Jurusan::create(['nama_jurusan' => 'Informatika']);
        $jurusanSi = Jurusan::create(['nama_jurusan' => 'Sistem Informasi']);

        // Buat Admin Informatika
        $adminIf = User::create([
            'name' => 'Admin Informatika',
            'email' => 'admin.if@example.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
            'jurusan_id' => $jurusanIf->id,
        ]);

        // Buat pengaduan untuk Sistem Informasi
        $pengaduanSi = Pengaduan::create([
            'kode_pengaduan' => 'ADU-20260914-0001',
            'nama_pengadu' => 'Mahasiswa SI',
            'jurusan_id' => $jurusanSi->id,
            'nama_dosen' => 'Dosen SI',
            'isi_pengaduan' => 'Kendala akademik sistem informasi.',
            'status' => 'Proses',
        ]);

        // Bertindak sebagai Admin Informatika mencoba mengakses detail pengaduan Sistem Informasi (IDOR Test)
        $response = $this->actingAs($adminIf)->get(route('admin.pengaduan.show', $pengaduanSi->id));

        // Harus ditolak dengan status 403 Forbidden
        $response->assertStatus(403);
    }
}