<?php

namespace App\Http\Controllers;

use App\Models\FunfactBetawi;
use App\Models\Galeri;
use App\Models\PaketWisata;
use App\Models\PosKegiatan;
use App\Models\Testimoni;
use Illuminate\Database\QueryException;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman landing page utama.
     */
    public function index()
    {
        try {
            $pakets = PaketWisata::with('posKegiatan')->get();
            $posKegiatans = PosKegiatan::all();
            $galeris = Galeri::latest()->get();
            $testimonis = Testimoni::latest()->get();
            $funfacts = FunfactBetawi::all();
        } catch (QueryException) {
            $pakets = collect();
            $posKegiatans = collect();
            $galeris = collect();
            $testimonis = collect();
            $funfacts = collect();
        }

        return view('welcome', compact('pakets', 'posKegiatans', 'galeris', 'testimonis', 'funfacts'));
    }
}
