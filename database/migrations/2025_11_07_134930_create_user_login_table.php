<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi untuk membuat tabel user.
     */
    public function up(): void
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->unique();
            $table->enum('role', [0, 1, 2])->default(0); // 0=Admin, 1=SuperAdmin, 2=Customer
            $table->boolean('status')->default(1); // 1=Aktif, 0=Nonaktif
            $table->string('password');
            $table->string('hp', 13);
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Rollback tabel user jika dibatalkan.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
