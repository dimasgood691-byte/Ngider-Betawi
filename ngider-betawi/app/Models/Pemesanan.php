<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanan';

    protected $fillable = [
        'kode_booking',
        'paket_wisata_id',
        'jadwal_wisata_id',
        'nama_lengkap',
        'no_telepon',
        'email',
        'asal_sekolah',
        'rentang_umur',
        'jumlah_peserta',
        'status',
    ];

    public function paketWisata()
    {
        return $this->belongsTo(PaketWisata::class);
    }

    public function jadwalWisata()
    {
        return $this->belongsTo(JadwalWisata::class);
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }
}
