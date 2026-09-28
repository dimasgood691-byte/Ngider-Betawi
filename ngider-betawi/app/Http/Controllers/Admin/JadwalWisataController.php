<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalWisata;
use Illuminate\Http\Request;

class JadwalWisataController extends Controller
{
    public function index(Request $request)
    {
        $query = JadwalWisata::withCount(['pemesanan'])->orderBy('tanggal', 'desc');

        if ($request->has('filter') && $request->filter === 'upcoming') {
            $query->where('tanggal', '>=', now()->toDateString())->orderBy('tanggal', 'asc');
        } elseif ($request->has('filter') && $request->filter === 'past') {
            $query->where('tanggal', '<', now()->toDateString());
        }

        $jadwals = $query->paginate(15)->withQueryString();

        $stats = [
            'total' => JadwalWisata::count(),
            'upcoming' => JadwalWisata::where('tanggal', '>=', now()->toDateString())->count(),
            'total_kuota' => JadwalWisata::sum('kuota'),
            'sisa_kuota' => JadwalWisata::where('tanggal', '>=', now()->toDateString())->sum('sisa_kuota'),
        ];

        return view('admin.jadwals.index', compact('jadwals', 'stats'));
    }

    public function create()
    {
        return view('admin.jadwals.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date|unique:jadwal_wisata,tanggal',
            'kuota' => 'required|integer|min:1|max:1000',
        ], [
            'tanggal.unique' => 'Jadwal untuk tanggal tersebut sudah terdaftar.',
            'kuota.min' => 'Kuota minimal adalah 1 peserta.',
        ]);

        JadwalWisata::create([
            'tanggal' => $validated['tanggal'],
            'kuota' => $validated['kuota'],
            'sisa_kuota' => $validated['kuota'],
        ]);

        return redirect()->route('admin.jadwals.index')->with('success', 'Jadwal dan kuota kunjungan wisata berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $jadwal = JadwalWisata::with('pemesanan.paketWisata')->findOrFail($id);

        return view('admin.jadwals.edit', compact('jadwal'));
    }

    public function update(Request $request, $id)
    {
        $jadwal = JadwalWisata::findOrFail($id);

        $validated = $request->validate([
            'tanggal' => 'required|date|unique:jadwal_wisata,tanggal,'.$jadwal->id,
            'kuota' => 'required|integer|min:1|max:1000',
        ]);

        // Hitung kuota yang sudah terpakai
        $terpakai = $jadwal->kuota - $jadwal->sisa_kuota;
        if ($validated['kuota'] < $terpakai) {
            return back()->withErrors([
                'kuota' => "Kuota tidak boleh lebih kecil dari jumlah kuota yang sudah terpakai ({$terpakai} peserta).",
            ])->withInput();
        }

        $sisaBaru = $validated['kuota'] - $terpakai;

        $jadwal->update([
            'tanggal' => $validated['tanggal'],
            'kuota' => $validated['kuota'],
            'sisa_kuota' => $sisaBaru,
        ]);

        return redirect()->route('admin.jadwals.index')->with('success', 'Jadwal dan kuota berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $jadwal = JadwalWisata::withCount('pemesanan')->findOrFail($id);

        if ($jadwal->pemesanan_count > 0) {
            return back()->with('error', 'Tidak dapat menghapus jadwal karena sudah memiliki pemesanan terkait.');
        }

        $jadwal->delete();

        return redirect()->route('admin.jadwals.index')->with('success', 'Jadwal kunjungan berhasil dihapus!');
    }
}
