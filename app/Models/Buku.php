<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $connection = 'pgsql_pusat';
    protected $table = 'buku';
    protected $fillable = ['kategori_id', 'penerbit_id', 'isbn', 'judul', 'penulis', 'harga_nasional'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function penerbit()
    {
        return $this->belongsTo(Penerbit::class);
    }
}
