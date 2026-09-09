<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalPemesanan' => Pemesanan::count(),
            'pemesananPending' => Pemesanan::where('status', 'menunggu_verifikasi')->count(),
            'pemesananConfirmed' => Pemesanan::where('status', 'dikonfirmasi')->count(),
            'totalPendapatan' => 0,
            'latestBookings' => Pemesanan::latest()->limit(10)->get(),
        ]);
    }
}
