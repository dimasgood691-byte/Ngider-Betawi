<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\PaketWisata;
use App\Models\PosKegiatan;
use App\Models\JadwalWisata;
use App\Models\FunfactBetawi;
use App\Models\Testimoni;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin Utama
        User::create([
            'name' => 'Admin Ngider Betawi',
            'email' => 'admin@ngiderbetawi.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);
    }
}