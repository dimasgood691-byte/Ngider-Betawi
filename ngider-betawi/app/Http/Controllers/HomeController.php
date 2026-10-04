<?php

namespace App\Http\Controllers;

use App\Models\FunfactBetawi;
use App\Models\Galeri;
use App\Models\PaketWisata;
use App\Models\PosKegiatan;
use App\Models\Testimoni;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman landing page utama.
     */
    public function index()
    {
        $pakets = PaketWisata::with('posKegiatan')->get();
        $posKegiatans = PosKegiatan::all();
        $galeris = Galeri::latest()->get();
        $testimonis = Testimoni::latest()->get();
        $funfacts = Schema::hasTable('funfact_betawi')
            ? FunfactBetawi::all()
            : collect();

        return view('welcome', compact('pakets', 'posKegiatans', 'galeris', 'testimonis', 'funfacts'));
    }
}
