<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Logika sederhana: Cek apakah user sudah 'auth' (nanti kita buat loginnya)
        // Untuk sekarang, kita cek session manual dulu biar kamu paham konsepnya
        if (!session()->has('is_admin')) {
            return redirect('/')->with('error', 'Eitss, mau ke mana? Kamu bukan admin! ⛔');
    }

        return $next($request);
    }
}
