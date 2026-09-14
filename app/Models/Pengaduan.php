<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $fillable = [
        'kode_pengaduan',
        'nama_pengadu',
        'jurusan_id',
        'nama_dosen',
        'isi_pengaduan',
        'status',
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function histories()
    {
        // Urutkan riwayat dari yang terlama ke terbaru agar timeline tersusun rapi secara kronologis
        return $this->hasMany(PengaduanHistory::class)->oldest();
    }
}