<h2>Katalog Buku</h2>
<a href="{{ route('cart.show') }}">Keranjang ({{ count((array) session('cart')) }})</a>

<div style="display: flex; gap: 20px; flex-wrap: wrap;">
    @foreach($buku as $item)
    <div style="border: 1px solid #ccc; padding: 15px; width: 200px;">
        <h4>{{ $item->judul }}</h4>
        <p>Penulis: {{ $item->penulis }}</p>
        <p>Harga: Rp {{ number_format($item->harga_nasional, 0, ',', '.') }}</p>
        <form action="{{ route('cart.add', $item->id) }}" method="POST">
            @csrf
            <button type="submit">Tambah ke Keranjang</button>
        </form>
    </div>
    @endforeach
</div>
