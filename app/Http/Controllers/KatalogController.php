<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function index()
    {
        $buku = Buku::all(); // Mengambil dari db_pusat

        return view('user.index', compact('buku'));
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
