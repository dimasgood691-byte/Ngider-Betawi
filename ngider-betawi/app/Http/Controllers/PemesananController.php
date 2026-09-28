<?php

namespace App\Http\Controllers;

use App\Models\JadwalWisata;
use App\Models\PaketWisata;
use App\Models\Pembayaran;
use App\Models\Pemesanan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PemesananController extends Controller
{
    public function create($paket_id = null)
    {
        $pakets = PaketWisata::with('posKegiatan')->get();
        $selectedPaketId = $paket_id;
        $jadwals = JadwalWisata::where('tanggal', '>=', now()->toDateString())
            ->orderBy('tanggal', 'asc')
            ->get();

        return view('booking.create', compact('pakets', 'selectedPaketId', 'jadwals'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'paket_wisata_id' => 'required|exists:paket_wisata,id',
            'nama_instansi' => 'required|string|max:255',
            'nama_pemesan' => 'required|string|max:255',
            'no_whatsapp' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'jadwal_wisata_id' => 'required|exists:jadwal_wisata,id',
            'jumlah_peserta' => 'required|integer|min:20',
            'rentang_umur' => 'nullable|string|max:50',
            'catatan' => 'nullable|string',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
        $kodeBooking = 'NB-'.strtoupper(Str::random(6));

        $jadwal = JadwalWisata::findOrFail($validated['jadwal_wisata_id']);

        if (Carbon::parse($jadwal->tanggal)->lt(now()->toDateString())) {
            return back()
                ->withInput()
                ->withErrors(['jadwal_wisata_id' => 'Jadwal kunjungan tersebut sudah terlewat.']);
        }

        if ($jadwal->sisa_kuota < $validated['jumlah_peserta']) {
            return back()
                ->withInput()
                ->withErrors(['jumlah_peserta' => 'Kuota kunjungan pada tanggal tersebut tidak mencukupi. Sisa kuota: '.$jadwal->sisa_kuota.' peserta.']);
        }

        DB::transaction(function () use ($validated, $path, $kodeBooking, $jadwal) {
            $jadwal->decrement('sisa_kuota', $validated['jumlah_peserta']);

            $pemesanan = Pemesanan::create([
                'kode_booking' => $kodeBooking,
                'paket_wisata_id' => $validated['paket_wisata_id'],
                'jadwal_wisata_id' => $jadwal->id,
                'nama_lengkap' => $validated['nama_pemesan'],
                'no_telepon' => $validated['no_whatsapp'],
                'email' => $validated['email'] ?? ('booking-'.strtolower(Str::random(8)).'@ngiderbetawi.local'),
                'asal_sekolah' => $validated['nama_instansi'],
                'rentang_umur' => $validated['rentang_umur'] ?? 'Pelajar / Umum',
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

        return redirect()->route('booking.success', $kodeBooking);
    }

    public function success($kode_booking)
    {
        $pemesanan = Pemesanan::with(['paketWisata', 'jadwalWisata', 'pembayaran'])
            ->where('kode_booking', $kode_booking)
            ->firstOrFail();

        return view('booking.success', compact('pemesanan'));
    }

    public function track(Request $request)
    {
        $query = $request->input('code') ?? $request->input('q');
        $pemesanan = null;

        if (! empty($query)) {
            $cleanQuery = trim($query);
            $pemesanan = Pemesanan::with(['paketWisata.posKegiatan', 'jadwalWisata', 'pembayaran'])
                ->where('kode_booking', $cleanQuery)
                ->orWhere('no_telepon', $cleanQuery)
                ->latest()
                ->first();
        }

        return view('booking.track', compact('pemesanan', 'query'));
    }
}
