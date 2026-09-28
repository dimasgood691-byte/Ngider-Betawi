<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AktivitasLog extends Model
{
    use HasFactory;

    protected $table = 'aktivitas_log';

    protected $fillable = [
        'user_id',
        'aksi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
