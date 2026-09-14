<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaduanHistory extends Model
{
    protected $fillable = [
        'pengaduan_id',
        'user_id',
        'status_sebelumnya',
        'status_baru',
        'catatan',
    ];

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}