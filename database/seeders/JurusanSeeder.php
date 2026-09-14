<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jurusan;

class JurusanSeeder extends Seeder
{
    public function run(): void
    {
        $jurusans = [
            ['nama_jurusan' => 'Informatika'],
            ['nama_jurusan' => 'Sistem Informasi'],
            ['nama_jurusan' => 'Farmasi'],
            ['nama_jurusan' => 'Agribisnis'],
            ['nama_jurusan' => 'Teknik Elektro'],
        ];

        foreach ($jurusans as $jurusan) {
            Jurusan::create($jurusan);
        }
    }
}