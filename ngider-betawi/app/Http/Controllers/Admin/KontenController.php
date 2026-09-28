<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FunfactBetawi;
use App\Models\Galeri;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KontenController extends Controller
{
    public function index()
    {
        $funfacts = FunfactBetawi::latest()->get();
        $galeris = Galeri::latest()->get();
        $testimonis = Testimoni::latest()->get();

        return view('admin.konten.index', compact('funfacts', 'galeris', 'testimonis'));
    }

    // --- 1. Funfact Betawi ---
    public function storeFunfact(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('funfacts', 'public');
        }

        FunfactBetawi::create($validated);

        return redirect()->route('admin.konten.index')->with('success', 'Fun fact kebudayaan Betawi berhasil ditambahkan!');
    }

    public function destroyFunfact($id)
    {
        $funfact = FunfactBetawi::findOrFail($id);

        if ($funfact->gambar && Storage::disk('public')->exists($funfact->gambar)) {
            Storage::disk('public')->delete($funfact->gambar);
        }

        $funfact->delete();

        return redirect()->route('admin.konten.index')->with('success', 'Fun fact Betawi berhasil dihapus!');
    }

    // --- 2. Galeri Foto Kegiatan ---
    public function storeGaleri(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        $path = $request->file('gambar')->store('galeri', 'public');
        $validated['gambar'] = $path;

        Galeri::create($validated);

        return redirect()->route('admin.konten.index')->with('success', 'Foto dokumentasi kegiatan berhasil diunggah!');
    }

    public function destroyGaleri($id)
    {
        $galeri = Galeri::findOrFail($id);

        if ($galeri->gambar && Storage::disk('public')->exists($galeri->gambar)) {
            Storage::disk('public')->delete($galeri->gambar);
        }

        $galeri->delete();

        return redirect()->route('admin.konten.index')->with('success', 'Foto dokumentasi berhasil dihapus!');
    }

    // --- 3. Testimoni Sekolah ---
    public function storeTestimoni(Request $request)
    {
        $validated = $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'isi' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Testimoni::create($validated);

        return redirect()->route('admin.konten.index')->with('success', 'Ulasan dan testimoni sekolah berhasil ditambahkan!');
    }

    public function destroyTestimoni($id)
    {
        $testimoni = Testimoni::findOrFail($id);
        $testimoni->delete();

        return redirect()->route('admin.konten.index')->with('success', 'Testimoni berhasil dihapus!');
    }
}
