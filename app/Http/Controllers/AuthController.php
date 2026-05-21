<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Proses autentikasi
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Pengalihan cerdas berdasarkan Role/Hak Akses
            $user = Auth::user();
            if ($user->role === 'SUPER_ADMIN') {
                return redirect()->route('buku.index'); 
            } elseif ($user->role === 'ADMIN_CABANG') {
                return redirect()->route('cabang.penerimaan');
            } elseif ($user->role === 'KASIR') {
                return redirect()->route('kasir.pos');
            } else {
                return redirect()->route('katalog.index');
            }
        }

        // Jika login gagal
        return redirect()->back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}