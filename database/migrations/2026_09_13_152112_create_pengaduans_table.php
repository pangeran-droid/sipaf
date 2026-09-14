<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pengaduan')->unique();
            $table->string('nama_pengadu');
            $table->foreignId('jurusan_id')->constrained('jurusans')->onDelete('restrict');
            $table->string('nama_dosen');
            $table->text('isi_pengaduan');
            $table->enum('status', ['Proses', 'Sedang Ditangani', 'Selesai'])->default('Proses');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaduans');
    }
};