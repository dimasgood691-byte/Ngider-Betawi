<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FunfactBetawi extends Model
{
    use HasFactory;

    protected $table = 'funfact_betawi';

    protected $fillable = [
        'judul',
        'isi',
        'gambar',
    ];
}
