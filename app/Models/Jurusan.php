<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $fillable = ['nama_jurusan'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function pengaduans()
    {
        return $this->hasMany(Pengaduan::class);
    }
}