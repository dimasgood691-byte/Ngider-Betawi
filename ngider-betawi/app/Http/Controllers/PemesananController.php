<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\PaketWisata;
use App\Models\JadwalWisata;
use App\Models\Pemesanan; // Sesuaikan dengan nama Model pemesanan kamu
use App\Models\Pembayaran;

class PemesananController extends Controller
{
    public function create($paket_id = null)
    {
        $pakets = PaketWisata::all();
        $selectedPaketId = $paket_id;

        return view('booking.create', compact('pakets', 'selectedPaketId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'paket_wisata_id' => 'required|exists:paket_wisata,id',
            'nama_instansi'    => 'required|string|max:255',
            'nama_pemesan'     => 'required|string|max:255',
            'no_whatsapp'      => 'required|string|max:20',
            'tanggal_kunjungan' => 'required|date|after:today',
            'jumlah_peserta'   => 'required|integer|min:20',
            'catatan'          => 'nullable|string',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

        DB::transaction(function () use ($validated, $path) {
            $jadwal = JadwalWisata::firstOrCreate(
                ['tanggal' => $validated['tanggal_kunjungan']],
                ['kuota' => 100, 'sisa_kuota' => 100]
            );

            if ($jadwal->sisa_kuota < $validated['jumlah_peserta']) {
                abort(422, 'Kuota kunjungan pada tanggal tersebut tidak mencukupi.');
            }

            $jadwal->decrement('sisa_kuota', $validated['jumlah_peserta']);

            $pemesanan = Pemesanan::create([
                'kode_booking' => 'NB-' . strtoupper(Str::random(6)),
                'paket_wisata_id' => $validated['paket_wisata_id'],
                'jadwal_wisata_id' => $jadwal->id,
                'nama_lengkap' => $validated['nama_pemesan'],
                'no_telepon' => $validated['no_whatsapp'],
                'email' => 'booking-' . strtolower(Str::random(10)) . '@ngiderbetawi.local',
                'asal_sekolah' => $validated['nama_instansi'],
                'rentang_umur' => 'Umum',
                'jumlah_peserta' => $validated['jumlah_peserta'],
                'status' => 'menunggu_verifikasi',
            ]);

            Pembayaran::create([
                'pemesanan_id' => $pemesanan->id,
                'metode' => 'transfer_bank',
                'bukti_file' => $path,
                'status_verifikasi' => 'pending',
                'catatan_admin' => $validated['catatan'] ?? null,
            ]);
        });

        return redirect()->route('home')->with('success', 'Pesanan berhasil dikirim! Bukti pembayaran kamu sedang diverifikasi admin.');
    }
}
