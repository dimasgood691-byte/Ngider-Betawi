<?php

namespace Tests\Feature\Admin;

use App\Models\JadwalWisata;
use App\Models\PaketWisata;
use App\Models\Pemesanan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaketWisataDeletionTest extends TestCase
{
    use RefreshDatabase;

    public function test_package_with_bookings_cannot_be_deleted(): void
    {
        $admin = User::query()->create([
            'name' => 'Admin Test',
            'email' => 'admin-paket@example.test',
            'password' => 'password',
            'role' => 'admin',
        ]);
        $package = PaketWisata::query()->create([
            'nama_paket' => 'Paket Edukasi',
            'deskripsi' => 'Paket edukasi Betawi',
            'harga' => 100000,
        ]);
        $schedule = JadwalWisata::query()->create([
            'tanggal' => '2026-10-15',
            'kuota' => 30,
            'sisa_kuota' => 30,
        ]);
        $booking = Pemesanan::query()->create([
            'kode_booking' => 'BOOK-TEST-001',
            'paket_wisata_id' => $package->id,
            'jadwal_wisata_id' => $schedule->id,
            'nama_lengkap' => 'Peserta Test',
            'no_telepon' => '081234567890',
            'email' => 'peserta@example.test',
            'asal_sekolah' => 'Sekolah Test',
            'rentang_umur' => '10-12 tahun',
            'jumlah_peserta' => 1,
            'status' => 'menunggu_verifikasi',
        ]);

        $this->actingAs($admin)
            ->delete(route('admin.pakets.destroy', $package))
            ->assertRedirectToRoute('admin.pakets.index')
            ->assertSessionHas('error', 'Paket wisata tidak dapat dihapus karena sudah memiliki pemesanan.');

        $this->assertModelExists($package);
        $this->assertModelExists($booking);
    }
}
