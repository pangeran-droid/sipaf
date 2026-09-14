<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaduan_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengaduan_id')->constrained('pengaduans')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null'); // Null jika sistem yang auto-update
            $table->string('status_sebelumnya');
            $table->string('status_baru');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaduan_histories');
    }
};