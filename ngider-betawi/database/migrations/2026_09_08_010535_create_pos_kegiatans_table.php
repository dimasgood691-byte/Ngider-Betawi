<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pos_kegiatan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pos');
            $table->text('deskripsi');
            $table->text('challenge');
            $table->text('reward');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pos_kegiatan');
    }
};
