<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaketWisata;
use App\Models\PosKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaketWisataController extends Controller
{
    public function index()
    {
        $pakets = PaketWisata::withCount(['posKegiatan', 'pemesanan'])->latest()->get();

        return view('admin.pakets.index', compact('pakets'));
    }

    public function create()
    {
        $posKegiatans = PosKegiatan::all();

        return view('admin.pakets.create', compact('posKegiatans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_paket' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'pos_kegiatan_ids' => 'nullable|array',
            'pos_kegiatan_ids.*' => 'exists:pos_kegiatan,id',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('paket_wisata', 'public');
        }

        $paket = PaketWisata::create([
            'nama_paket' => $validated['nama_paket'],
            'deskripsi' => $validated['deskripsi'],
            'harga' => $validated['harga'],
            'gambar' => $validated['gambar'] ?? null,
        ]);

        if (! empty($validated['pos_kegiatan_ids'])) {
            $paket->posKegiatan()->sync($validated['pos_kegiatan_ids']);
        }

        return redirect()->route('admin.pakets.index')->with('success', 'Paket wisata berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $paket = PaketWisata::with('posKegiatan')->findOrFail($id);
        $posKegiatans = PosKegiatan::all();
        $selectedPos = $paket->posKegiatan->pluck('id')->toArray();

        return view('admin.pakets.edit', compact('paket', 'posKegiatans', 'selectedPos'));
    }

    public function update(Request $request, $id)
    {
        $paket = PaketWisata::findOrFail($id);

        $validated = $request->validate([
            'nama_paket' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'pos_kegiatan_ids' => 'nullable|array',
            'pos_kegiatan_ids.*' => 'exists:pos_kegiatan,id',
        ]);

        if ($request->hasFile('gambar')) {
            if ($paket->gambar && Storage::disk('public')->exists($paket->gambar)) {
                Storage::disk('public')->delete($paket->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('paket_wisata', 'public');
        } else {
            $validated['gambar'] = $paket->gambar;
        }

        $paket->update([
            'nama_paket' => $validated['nama_paket'],
            'deskripsi' => $validated['deskripsi'],
            'harga' => $validated['harga'],
            'gambar' => $validated['gambar'],
        ]);

        $paket->posKegiatan()->sync($validated['pos_kegiatan_ids'] ?? []);

        return redirect()->route('admin.pakets.index')->with('success', 'Paket wisata berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $paket = PaketWisata::findOrFail($id);

        if ($paket->pemesanan()->exists()) {
            return redirect()->route('admin.pakets.index')
                ->with('error', 'Paket wisata tidak dapat dihapus karena sudah memiliki pemesanan.');
        }

        if ($paket->gambar && Storage::disk('public')->exists($paket->gambar)) {
            Storage::disk('public')->delete($paket->gambar);
        }

        $paket->posKegiatan()->detach();
        $paket->delete();

        return redirect()->route('admin.pakets.index')->with('success', 'Paket wisata berhasil dihapus!');
    }
}
