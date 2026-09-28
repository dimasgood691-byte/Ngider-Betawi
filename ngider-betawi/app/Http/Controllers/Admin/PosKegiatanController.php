<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PosKegiatan;
use Illuminate\Http\Request;

class PosKegiatanController extends Controller
{
    public function index()
    {
        $posKegiatans = PosKegiatan::withCount('paketWisata')->get();

        return view('admin.pos.index', compact('posKegiatans'));
    }

    public function create()
    {
        return view('admin.pos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pos' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'challenge' => 'required|string',
            'reward' => 'required|string',
        ]);

        PosKegiatan::create($validated);

        return redirect()->route('admin.pos.index')->with('success', 'Pos kegiatan edukasi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $pos = PosKegiatan::findOrFail($id);

        return view('admin.pos.edit', compact('pos'));
    }

    public function update(Request $request, $id)
    {
        $pos = PosKegiatan::findOrFail($id);

        $validated = $request->validate([
            'nama_pos' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'challenge' => 'required|string',
            'reward' => 'required|string',
        ]);

        $pos->update($validated);

        return redirect()->route('admin.pos.index')->with('success', 'Pos kegiatan edukasi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pos = PosKegiatan::findOrFail($id);
        $pos->paketWisata()->detach();
        $pos->delete();

        return redirect()->route('admin.pos.index')->with('success', 'Pos kegiatan edukasi berhasil dihapus!');
    }
}
