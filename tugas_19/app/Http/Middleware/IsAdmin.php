<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Periksa apakah pengguna sudah login dan memiliki role admin
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request);
        }

        // Tampilkan error 403 dengan teks tampilan bahasa Inggris jika bukan admin
        abort(403, 'Access Denied: You do not have administrator privileges.');
    }
}