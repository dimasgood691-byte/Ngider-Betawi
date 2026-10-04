<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('funfact_betawi')) {
            return;
        }

        Schema::create('funfact_betawi', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('isi');
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Preserve the table because it may have existed before this repair migration.
     */
    public function down(): void {}
};
