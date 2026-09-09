<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;

class PemesananController extends Controller
{
    public function index()
    {
        return response()->json(Pemesanan::latest()->get());
    }
}