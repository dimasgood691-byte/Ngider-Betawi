<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('paket_pos_kegiatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paket_wisata_id')->constrained('paket_wisata')->cascadeOnDelete();
            $table->foreignId('pos_kegiatan_id')->constrained('pos_kegiatan')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paket_pos_kegiatan');
    }
};