<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::query()->orderBy('role', 'asc')->get();
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role'     => 'required|in:SUPER_ADMIN,ADMIN_CABANG,KASIR,PELANGGAN'
        ]);

        User::query()->create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('user.index')->with('success', 'Pengguna baru berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $user = User::query()->findOrFail($id);
        return view('admin.user.update', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::query()->findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            // Pengecualian unik untuk email milik user yang sedang diedit
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role'  => 'required|in:SUPER_ADMIN,ADMIN_CABANG,KASIR,PELANGGAN',
            'password' => 'nullable|string|min:8' // Password opsional saat update
        ]);

        $dataUpdate = [
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
        ];

        // Jika form password diisi, berarti admin ingin mereset password user tersebut
        if ($request->filled('password')) {
            $dataUpdate['password'] = Hash::make($request->password);
        }

        $user->update($dataUpdate);

        return redirect()->route('user.index')->with('success', 'Data pengguna berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        if (auth()->id() == $user->id) {
            return redirect()->route('user.index')->with('error', 'Akses Ditolak: Anda tidak dapat menghapus akun Anda sendiri saat sedang login!');
        }

        $user->delete();

        return redirect()->route('user.index')->with('success', 'Pengguna berhasil dihapus!');
    }
}
