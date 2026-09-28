<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemesanan_id')->constrained('pemesanan')->cascadeOnDelete();
            $table->enum('metode', ['transfer_bank', 'qris']);
            $table->string('bukti_file');
            $table->enum('status_verifikasi', ['pending', 'valid', 'invalid'])->default('pending');
            $table->text('catatan_admin')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
