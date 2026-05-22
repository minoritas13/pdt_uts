<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function showRegister(){
        return view('registrasi');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // 'confirmed' wajib ada input password_confirmation
        ]);

        $user = User::query()->create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'PELANGGAN',
        ]);

        return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Selamat datang di toko buku kami.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
