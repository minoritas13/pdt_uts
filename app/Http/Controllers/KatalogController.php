<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function index()
    {
        $buku = Buku::all(); // Mengambil dari db_pusat

        return view('user.index', compact('buku'));
    }

    public function allBooks(Request $request)
    {
        $kategori = Kategori::all(); 
        
        $query = Buku::query();

        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;

            $query->where(function($q) use ($searchTerm) {
                $q->where('judul', 'ILIKE', '%' . $searchTerm . '%')
                ->orWhere('penulis', 'ILIKE', '%' . $searchTerm . '%');
            });
        }

        if ($request->has('kategori_id') && $request->kategori_id != '') {
            $query->where('kategori_id', $request->kategori_id);
        }

        $buku = $query->get();

        return view('user.list', compact('buku', 'kategori')); 
    }

    public function showDetail($id)
    {
        $bukuUtama = Buku::with(['kategori', 'penerbit'])->findOrFail($id);

        $bukuSerupa = Buku::where('id', '!=', $id)->take(5)->get();

        return view('user.detail', compact('bukuUtama', 'bukuSerupa'));
    }

    public function addToCart(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'judul' => $buku->judul,
                'quantity' => 1,
                'harga' => $buku->harga_nasional,
                'penulis' => $buku->penulis,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Buku ditambahkan ke keranjang!');
    }

    public function showCart()
    {
        return view('user.cart');
    }

    public function updateCart(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);

            return response()->json(['message' => 'Keranjang diperbarui']);
        }
    }

    public function removeFromCart(string $id)
    {
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            // Menghapus item berdasarkan ID dari array session
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Buku berhasil dihapus dari keranjang!');
    }
}
