<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalWisata;
use App\Models\PaketWisata;
use App\Models\Pemesanan;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPemesanan = Pemesanan::count();
        $pemesananPending = Pemesanan::where('status', 'menunggu_verifikasi')->count();
        $pemesananConfirmed = Pemesanan::whereIn('status', ['terverifikasi', 'dikonfirmasi'])->count();
        $pemesananDitolak = Pemesanan::where('status', 'ditolak')->count();

        // Hitung estimasi omset dari pemesanan yang terkonfirmasi
        $totalPendapatan = Pemesanan::whereIn('status', ['terverifikasi', 'dikonfirmasi'])
            ->with('paketWisata')
            ->get()
            ->sum(function ($item) {
                return ($item->paketWisata->harga ?? 0) * $item->jumlah_peserta;
            });

        $totalPeserta = Pemesanan::whereIn('status', ['terverifikasi', 'dikonfirmasi'])->sum('jumlah_peserta');

        $latestBookings = Pemesanan::with(['paketWisata', 'jadwalWisata', 'pembayaran'])
            ->latest()
            ->limit(8)
            ->get();

        $upcomingJadwals = JadwalWisata::where('tanggal', '>=', now()->toDateString())
            ->orderBy('tanggal', 'asc')
            ->limit(5)
            ->get();

        $totalPaket = PaketWisata::count();

        return view('admin.dashboard', compact(
            'totalPemesanan',
            'pemesananPending',
            'pemesananConfirmed',
            'pemesananDitolak',
            'totalPendapatan',
            'totalPeserta',
            'latestBookings',
            'upcomingJadwals',
            'totalPaket'
        ));
    }
}
