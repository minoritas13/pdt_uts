<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$roles (Bisa menerima banyak role sekaligus)
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // 1. Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors([
                'email' => 'Silakan login terlebih dahulu untuk mengakses halaman tersebut.'
            ]);
        }

        // 2. Ambil data user yang sedang login
        $user = Auth::user();

        // 3. Cek apakah role user tersebut ada di dalam daftar role yang diizinkan
        if (in_array($user->role, $roles)) {
            return $next($request); // Izinkan masuk
        }

        // 4. Jika role tidak cocok, blokir dan tampilkan error 403
        abort(403, 'Akses Ditolak! Anda tidak memiliki hak akses (role) untuk membuka halaman ini.');
    }
}
