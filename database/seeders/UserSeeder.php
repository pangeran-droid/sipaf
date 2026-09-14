<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Jurusan;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $password = Hash::make('password123'); // Password default

        // Super Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => $password,
            'role' => 'super_admin',
            'jurusan_id' => null,
        ]);

        // Get Jurusan IDs
        $if = Jurusan::where('nama_jurusan', 'Informatika')->first()->id;
        $si = Jurusan::where('nama_jurusan', 'Sistem Informasi')->first()->id;
        $farmasi = Jurusan::where('nama_jurusan', 'Farmasi')->first()->id;
        $agribisnis = Jurusan::where('nama_jurusan', 'Agribisnis')->first()->id;
        $elektro = Jurusan::where('nama_jurusan', 'Teknik Elektro')->first()->id;

        // Admin Jurusan
        User::create([
            'name' => 'Admin Informatika',
            'email' => 'admin.informatika@example.com',
            'password' => $password,
            'role' => 'admin',
            'jurusan_id' => $if,
        ]);

        User::create([
            'name' => 'Admin Sistem Informasi',
            'email' => 'admin.si@example.com',
            'password' => $password,
            'role' => 'admin',
            'jurusan_id' => $si,
        ]);

        User::create([
            'name' => 'Admin Farmasi',
            'email' => 'admin.farmasi@example.com',
            'password' => $password,
            'role' => 'admin',
            'jurusan_id' => $farmasi,
        ]);

        User::create([
            'name' => 'Admin Agribisnis',
            'email' => 'admin.agribisnis@example.com',
            'password' => $password,
            'role' => 'admin',
            'jurusan_id' => $agribisnis,
        ]);

        User::create([
            'name' => 'Admin Teknik Elektro',
            'email' => 'admin.elektro@example.com',
            'password' => $password,
            'role' => 'admin',
            'jurusan_id' => $elektro,
        ]);
    }
}