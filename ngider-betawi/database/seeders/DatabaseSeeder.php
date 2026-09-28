<?php

namespace Database\Seeders;

use App\Models\FunfactBetawi;
use App\Models\JadwalWisata;
use App\Models\PaketWisata;
use App\Models\PosKegiatan;
use App\Models\Testimoni;
use App\Models\User;
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

        // 2. Data Master Pos Kegiatan
        $pos1 = PosKegiatan::create([
            'nama_pos' => 'Melukis Topeng Betawi',
            'deskripsi' => 'Mengenal kebudayaan topeng Betawi dan mengasah kreativitas siswa.',
            'challenge' => 'Mewarnai topeng kayu dengan pola warna khas Betawi.',
            'reward' => 'Sertifikat Kreativitas + Topeng Hasil Karya',
        ]);

        $pos2 = PosKegiatan::create([
            'nama_pos' => 'Bermain Musik Gambang Kromong',
            'deskripsi' => 'Praktik langsung alat musik tradisional Betawi bersama maestro.',
            'challenge' => 'Memainkan nada lagu "Sirih Kuning" secara bersama-sama.',
            'reward' => 'Pin Pengenalan Musik Tradisional',
        ]);

        $pos3 = PosKegiatan::create([
            'nama_pos' => 'Aksi Bersih Ciliwung',
            'deskripsi' => 'Edukasi lingkungan dan pengelolaan sampah di bantaran sungai.',
            'challenge' => 'Memilah 5 kg sampah organik & anorganik dalam kelompok.',
            'reward' => 'Lencana Pelopor Lingkungan Ciliwung',
        ]);

        $pos4 = PosKegiatan::create([
            'nama_pos' => 'Menanam Endemik Betawi',
            'deskripsi' => 'Penanaman pohon langka seperti Kecapi, Gandaria, dan Salak Condet.',
            'challenge' => 'Menanam 1 bibit pohon dengan teknik pembibitan yang benar.',
            'reward' => 'Tanaman Hias Edukasi untuk Sekolah',
        ]);

        // 3. Paket Wisata
        $paket1 = PaketWisata::create([
            'nama_paket' => 'Paket Betawi Cilik (Art & Culture)',
            'deskripsi' => 'Fokus pada eksplorasi seni, musik, dan kebudayaan fisik Betawi.',
            'harga' => 75000,
            'gambar' => null,
        ]);
        $paket1->posKegiatan()->attach([$pos1->id, $pos2->id]);

        $paket2 = PaketWisata::create([
            'nama_paket' => 'Paket Ciliwung Eco-Explorer',
            'deskripsi' => 'Eksplorasi penuh budaya Betawi plus aksi peduli lingkungan Ciliwung.',
            'harga' => 120000,
            'gambar' => null,
        ]);
        $paket2->posKegiatan()->attach([$pos1->id, $pos2->id, $pos3->id, $pos4->id]);

        // 4. Jadwal Wisata
        JadwalWisata::create([
            'tanggal' => now()->addDays(3)->format('Y-m-d'),
            'kuota' => 50,
            'sisa_kuota' => 50,
        ]);
        JadwalWisata::create([
            'tanggal' => now()->addDays(7)->format('Y-m-d'),
            'kuota' => 60,
            'sisa_kuota' => 60,
        ]);

        // 5. Funfact Betawi
        FunfactBetawi::create([
            'judul' => 'Asal Usul Ondel-Ondel',
            'isi' => 'Dahulu Ondel-Ondel bernama Barongan dan berfungsi sebagai penolak bala dari gangguan roh jahat.',
            'gambar' => null,
        ]);

        // 6. Testimoni
        Testimoni::create([
            'nama_sekolah' => 'SDN Condet 01 Pagi',
            'isi' => 'Anak-anak sangat antusias melukis topeng dan belajar menjaga Ciliwung. Konsep gamifikasinya top!',
            'rating' => 5,
        ]);

        Testimoni::create([
            'nama_sekolah' => 'SDN Condet 02 Pagi',
            'isi' => 'Anak-anak sangat antusias melukis topeng dan belajar menjaga Ciliwung. Konsep gamifikasinya top!',
            'rating' => 5,
        ]);

        Testimoni::create([
            'nama_sekolah' => 'SDN Condet 03 Pagi',
            'isi' => 'Anak-anak sangat antusias melukis topeng dan belajar menjaga Ciliwung. Konsep gamifikasinya top!',
            'rating' => 5,
        ]);
    }
}
