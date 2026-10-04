<?php

namespace Database\Seeders;

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
            'email' => 'ngiderbetawi@gmail.com',
            'password' => Hash::make('ngiderbetawi2026'),
            'role' => 'admin',
        ]);

        // 2. Data Master Pos Kegiatan
        $pos1 = PosKegiatan::create([
            'nama_pos' => 'Menabuh Harmoni lewat Marawis',
            'deskripsi' => 'Mengenal sejarah, fungsi sosial, dan filosofi marawis sebagai perpaduan budaya Arab, Melayu, dan Betawi, lalu memainkannya bersama seniman Padepokan Ciliwung Condet.',
            'challenge' => 'Pelajari irama dasar lalu mainkan marawis bersama kelompok hingga tercipta harmoni.',
            'reward' => 'Cap Misi #1',
        ]);

        $pos2 = PosKegiatan::create([
            'nama_pos' => 'Makna dibalik Topeng Betawi',
            'deskripsi' => 'Memahami filosofi warna dan karakter Topeng Betawi, lalu melukis topeng kosong sebagai suvenir budaya.',
            'challenge' => 'Lukis topeng kosong dengan warna dan karakter sesuai kreativitasmu.',
            'reward' => 'Cap Misi #2',
        ]);

        $pos3 = PosKegiatan::create([
            'nama_pos' => 'Menjaga Ciliwung & Warisan Betawi',
            'deskripsi' => 'Aksi konservasi Ciliwung melalui bersih sampah bantaran, menanam pohon endemik Loa atau Melinjo, dan refleksi filosofi Kembar Aer.',
            'challenge' => 'Bersihkan area bantaran, tanam pohon endemik, dan ikuti sesi refleksi alam serta budaya.',
            'reward' => 'Cap Misi #3 (Selesai)',
        ]);

        // 3. Paket Wisata
        $paket1 = PaketWisata::create([
            'nama_paket' => 'Ngider Betawi Tour Package',
            'deskripsi' => 'Paket wisata edukatif untuk mengenal budaya Betawi melalui berbagai kegiatan menarik.',
            'harga' => 100000,
            'gambar' => null,
        ]);
        $paket1->posKegiatan()->attach([$pos1->id, $pos2->id, $pos3->id]);

        // 4. Jadwal Wisata
        JadwalWisata::create([
            'tanggal' => now()->addDays(3)->format('Y-m-d'),
            'kuota' => 150,
            'sisa_kuota' => 150,
        ]);

        // 5. Testimoni
        Testimoni::create([
            'nama_sekolah' => 'SMPN 43 JAKARTA',
            'isi' => 'SERU BANGET, pemateri menyamakan materi nya dengan sangat baik dan jelas, penyelenggara pun bersikap sangat baik dan ramah terhadap peserta wisata seperti saya. Dengan 100k sudah mendapatkan semuanya, saya rasa ini sangat sebanding',
            'rating' => 5,
        ]);

        Testimoni::create([
            'nama_sekolah' => "MTSN AS'SAADAH CONDET",
            'isi' => 'terimakasih kepada ka audita dan tim, karna keramaha tamahan nya dan sistem nya sangat bagus, kami merasa sangat senang, bahagia dan puas, saya harap kegiatan ngider betawi dapat dikenal luas oleh masyarakat karna sangat bermanfaat di era sekarang.',
            'rating' => 5,
        ]);

        Testimoni::create([
            'nama_sekolah' => 'SDN BALEKAMBANG 01',
            'isi' => 'Kesan aku, acara Ngider Betawi kemaren di Padepokan Ciliwung Condet seru abis dan dapet banget feel budayanya! Pesan buat tim panitia, terus semangat ya ngadain acara keren kayak gini biar aku dan temen-temen generasi muda makin paham ama tradisi sendiri dan kagak kuper soal budaya Betawi. Paling saran dari aku, ke depannya makin banyakin aja aktivitas seru atau game interaktifnya pas keliling biar suasananya tambah pecah dan kagak bosenin. Sukses terus buat tim Ngider Betawi! 😊',
            'rating' => 5,
        ]);
    }
}
