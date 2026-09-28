<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check() || Auth::user()->role !== 'admin') {
            Auth::logout();

            return redirect()->route('admin.login')
                ->with('error', 'Akses ditolak! Silakan login sebagai Admin terlebih dahulu.');
        }

        return $next($request);
    }
}
