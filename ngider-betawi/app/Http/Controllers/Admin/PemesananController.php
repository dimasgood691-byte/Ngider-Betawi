<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AktivitasLog;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PemesananController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->input('status');
        $search = $request->input('q');

        $query = Pemesanan::with(['paketWisata', 'jadwalWisata', 'pembayaran'])->latest();

        if (! empty($status)) {
            $query->where('status', $status);
        }

        if (! empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('kode_booking', 'like', "%{$search}%")
                    ->orWhere('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('asal_sekolah', 'like', "%{$search}%")
                    ->orWhere('no_telepon', 'like', "%{$search}%");
            });
        }

        $pemesanans = $query->paginate(10)->withQueryString();

        $counts = [
            'all' => Pemesanan::count(),
            'menunggu_verifikasi' => Pemesanan::where('status', 'menunggu_verifikasi')->count(),
            'dikonfirmasi' => Pemesanan::whereIn('status', ['terverifikasi', 'dikonfirmasi'])->count(),
            'ditolak' => Pemesanan::where('status', 'ditolak')->count(),
        ];

        return view('admin.pemesanans.index', compact('pemesanans', 'counts', 'status', 'search'));
    }

    public function show($id)
    {
        $pemesanan = Pemesanan::with(['paketWisata.posKegiatan', 'jadwalWisata', 'pembayaran'])
            ->findOrFail($id);

        return view('admin.pemesanans.show', compact('pemesanan'));
    }

    public function verifyPayment(Request $request, $id)
    {
        $request->validate([
            'action' => 'required|in:approve,reject',
            'catatan_admin' => 'nullable|string|max:500',
        ]);

        $pemesanan = Pemesanan::with(['jadwalWisata', 'pembayaran'])->findOrFail($id);

        DB::transaction(function () use ($request, $pemesanan) {
            $isApprove = $request->action === 'approve';

            // Update status pemesanan
            $newStatus = $isApprove ? 'dikonfirmasi' : 'ditolak';

            // Jika sebelumnya belum ditolak dan sekarang ditolak, kembalikan sisa kuota ke jadwal
            if (! $isApprove && $pemesanan->status !== 'ditolak' && $pemesanan->jadwalWisata) {
                $pemesanan->jadwalWisata->increment('sisa_kuota', $pemesanan->jumlah_peserta);
            }

            // Jika sebelumnya ditolak dan sekarang diapprove kembali, kurangi lagi kuota
            if ($isApprove && $pemesanan->status === 'ditolak' && $pemesanan->jadwalWisata) {
                $pemesanan->jadwalWisata->decrement('sisa_kuota', $pemesanan->jumlah_peserta);
            }

            $pemesanan->update(['status' => $newStatus]);

            // Update data pembayaran
            $pembayaran = $pemesanan->pembayaran()->latest()->first();
            if ($pembayaran) {
                $pembayaran->update([
                    'status_verifikasi' => $isApprove ? 'valid' : 'invalid',
                    'catatan_admin' => $request->catatan_admin,
                    'verified_at' => now(),
                ]);
            }

            // Log aktivitas admin
            try {
                AktivitasLog::create([
                    'user_id' => auth()->id(),
                    'aksi' => ($isApprove ? 'Memverifikasi (Setujui)' : 'Menolak').' pesanan '.$pemesanan->kode_booking.' ('.$pemesanan->asal_sekolah.')',
                ]);
            } catch (\Exception $e) {
                // Abaikan jika log tidak kritis
            }
        });

        $msg = $request->action === 'approve'
            ? 'Pemesanan '.$pemesanan->kode_booking.' berhasil diverifikasi & dikonfirmasi!'
            : 'Pemesanan '.$pemesanan->kode_booking.' telah ditolak dan kuota dikembalikan.';

        return redirect()->route('admin.pemesanans.show', $pemesanan->id)->with('success', $msg);
    }

    public function destroy($id)
    {
        $pemesanan = Pemesanan::with('jadwalWisata')->findOrFail($id);

        // Jika status belum ditolak, kembalikan kuota
        if ($pemesanan->status !== 'ditolak' && $pemesanan->jadwalWisata) {
            $pemesanan->jadwalWisata->increment('sisa_kuota', $pemesanan->jumlah_peserta);
        }

        $kode = $pemesanan->kode_booking;
        $pemesanan->delete();

        return redirect()->route('admin.pemesanans.index')
            ->with('success', 'Data reservasi '.$kode.' berhasil dihapus dari sistem.');
    }

    public function printTicket($id)
    {
        $pemesanan = Pemesanan::with(['paketWisata.posKegiatan', 'jadwalWisata', 'pembayaran'])
            ->findOrFail($id);

        return view('admin.pemesanans.print', compact('pemesanan'));
    }
}
