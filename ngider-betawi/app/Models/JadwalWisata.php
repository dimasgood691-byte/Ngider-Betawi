<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalWisata extends Model
{
    use HasFactory;

    protected $table = 'jadwal_wisata';

    protected $fillable = [
        'tanggal',
        'kuota',
        'sisa_kuota',
    ];

    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class);
    }
}