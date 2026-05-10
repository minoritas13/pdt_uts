<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penerbit;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buku = Buku::with(['kategori','penerbit'])->get();

        return view('admin.dashboard', compact('buku'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::all();
        $penerbit = Penerbit::all();

        return view('admin.buku.create', compact('kategori', 'penerbit'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isbn' => 'required|string|unique:pgsql_pusat.buku,isbn',
            'harga_nasional' => 'required|numeric',
            'kategori_id' => 'required|exist:pgsql_pusat.kategori,id',
            'penerbit_id' => 'required|exist:pgsql_pusat.penerbit,id',            
        ]);
    }

    /**
    * Display the specified resource.
    * 
    *  public function show(string $id)
    *   {
    *       //
    *   }
    */
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $buku = Buku::FindOrFail($id);
        $kategori = Kategori::all();
        $penerbit = Penerbit::all();

        return view('buku.edit', compact('buku','kategori', 'penerbit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isbn' => 'required|string|unique:pgsql_pusat.buku,isbn'.$id,
            'harga_nasional' => 'required|numeric',
            'kategori_id' => 'required|exist:pgsql_pusat.kategori|id',
            'penerbit_id' => 'required|exist:pgsql_pusat.penerbit|id',
        ]);

        $buku = Buku::FindOrFail($id);
        $buku->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $buku = Buku::FindOrFail($id);
        $buku->delete();

        return response()->json(['message' => 'Buku Berhasil Dihapus']);
    }
}
