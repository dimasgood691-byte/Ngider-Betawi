<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_booking')->unique();
            $table->foreignId('paket_wisata_id')->constrained('paket_wisata');
            $table->foreignId('jadwal_wisata_id')->constrained('jadwal_wisata');
            $table->string('nama_lengkap');
            $table->string('no_telepon');
            $table->string('email');
            $table->string('asal_sekolah');
            $table->string('rentang_umur');
            $table->integer('jumlah_peserta');
            $table->enum('status', [
                'menunggu_verifikasi',
                'terverifikasi',
                'dikonfirmasi',
                'ditolak',
            ])->default('menunggu_verifikasi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemesanan');
    }
};
