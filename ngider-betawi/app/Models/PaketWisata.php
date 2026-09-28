<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketWisata extends Model
{
    use HasFactory;

    protected $table = 'paket_wisata';

    protected $fillable = [
        'nama_paket',
        'deskripsi',
        'harga',
        'gambar',
    ];

    public function posKegiatan()
    {
        return $this->belongsToMany(PosKegiatan::class, 'paket_pos_kegiatan');
    }

    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class);
    }
}
