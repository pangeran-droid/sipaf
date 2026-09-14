<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['super_admin', 'admin'])->default('admin')->after('password');
            $table->foreignId('jurusan_id')->nullable()->constrained('jurusans')->onDelete('restrict')->after('role');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['jurusan_id']);
            $table->dropColumn(['role', 'jurusan_id']);
        });
    }
};