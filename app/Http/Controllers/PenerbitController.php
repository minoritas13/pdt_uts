<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penerbit;

class PenerbitController extends Controller
{
    /**
     * Menampilkan semua data penerbit.
     */
    public function index()
    {
        $penerbit = Penerbit::all();

        // Gunakan ini jika membuat tampilan UI dengan Blade:
        return view('admin.penerbit.index', compact('penerbit'));

        // Gunakan ini untuk testing API sementara:
        return response()->json($penerbit);
    }

    /**
     * Menampilkan form tambah penerbit (Blade).
     */
    public function create()
    {
        return view('admin.penerbit.create');
    }

    /**
     * Menyimpan data penerbit baru ke database pusat.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_penerbit' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
        ]);

        Penerbit::create($request->all());

        //return response()->json(['message' => 'Penerbit berhasil ditambahkan']);
        return redirect()->route('penerbit.index')->with('success', 'Penerbit berhasil ditambah');
    }

    /**
     * Menampilkan satu data penerbit spesifik.
     */
    public function show(string $id)
    {
        /*
        $penerbit = Penerbit::findOrFail($id);

        // return view('penerbit.show', compact('penerbit'));
        return response()->json($penerbit);
        */
    }

    /**
     * Menampilkan form edit penerbit (Blade).
     */
    public function edit(string $id)
    {
        $penerbit = Penerbit::findOrFail($id);

        return view('admin.penerbit.update', compact('penerbit'));
    }

    /**
     * Memperbarui data penerbit di database pusat.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_penerbit' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
        ]);

        $penerbit = Penerbit::findOrFail($id);
        $penerbit->update($request->all());

        //return response()->json(['message' => 'Data penerbit berhasil diperbarui']);
        return redirect()->route('penerbit.index')->with('success', 'Penerbit diubah');
    }

    /**
     * Menghapus penerbit.
     */
    public function destroy(string $id)
    {
        $penerbit = Penerbit::findOrFail($id);
        $penerbit->delete();

        // return response()->json(['message' => 'Penerbit berhasil dihapus']);
        return redirect()->route('penerbit.index')->with('success', 'Penerbit dihapus');
    }
}
