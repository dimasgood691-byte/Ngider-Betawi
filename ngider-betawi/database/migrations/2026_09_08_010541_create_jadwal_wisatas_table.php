<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_wisata', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal')->unique();
            $table->integer('kuota');
            $table->integer('sisa_kuota');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_wisata');
    }
};
