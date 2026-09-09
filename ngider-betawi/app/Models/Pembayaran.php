<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [
        'pemesanan_id',
        'metode',
        'bukti_file',
        'status_verifikasi',
        'catatan_admin',
        'verified_at',
    ];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }
}