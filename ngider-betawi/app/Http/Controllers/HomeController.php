<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\PaketWisata;
use App\Models\PosKegiatan;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman landing page utama.
     */
    public function index()
    {
        try {
            $pakets = PaketWisata::all();
            $destinations = PosKegiatan::all();
        } catch (QueryException) {
            $pakets = collect();
            $destinations = collect();
        }

        // Jika database masih kosong, gunakan data dummy agar tampilan tidak kosong/error
        if ($destinations->isEmpty()) {
            $destinations = [
                [
                    'title' => 'Setu Babakan',
                    'category' => 'Seni & Budaya',
                    'image' => 'https://images.unsplash.com/photo-1596402184320-417e7178b2cd?auto=format&fit=crop&q=80&w=600',
                    'location' => 'Jagakarsa, Jakarta Selatan',
                    'rating' => 4.8,
                    'description' => 'Pusat Konservasi Budaya Betawi lengkap dengan wisata danau, kuliner khas, dan seni pertunjukan.'
                ],
                [
                    'title' => 'Kerak Telor Bang Udin',
                    'category' => 'Kuliner',
                    'image' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&q=80&w=600',
                    'location' => 'Kemayoran, Jakarta Pusat',
                    'rating' => 4.9,
                    'description' => 'Kuliner legendaris khas Betawi yang dimasak di atas anglo dengan bahan beras ketan dan telur bebek.'
                ],
                [
                    'title' => 'Museum Bahari',
                    'category' => 'Sejarah',
                    'image' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&q=80&w=600',
                    'location' => 'Penjaringan, Jakarta Utara',
                    'rating' => 4.6,
                    'description' => 'Bangunan bersejarah peninggalan VOC yang menyimpan koleksi kebaharian dan sejarah kemaritiman.'
                ],
            ];
        }

        return view('welcome', compact('pakets', 'destinations'));
    }
}