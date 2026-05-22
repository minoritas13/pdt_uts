<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buku extends Model
{
    use HasFactory;
    use SoftDeletes;

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

    protected static function booted(){

        static::deleting(function ($buku){

            StokGudangPusat::where('buku_id', $buku->id)->delete();

            StokLokal::where('buku_id', $buku->id)->delete();

        });
    }
}
