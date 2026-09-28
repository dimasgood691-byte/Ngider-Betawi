<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosKegiatan extends Model
{
    use HasFactory;

    // Tentukan nama tabel secara manual
    protected $table = 'pos_kegiatan';

    protected $fillable = [
        'nama_pos',
        'deskripsi',
        'challenge',
        'reward',
    ];

    public function paketWisata()
    {
        return $this->belongsToMany(PaketWisata::class, 'paket_pos_kegiatan');
    }
}
