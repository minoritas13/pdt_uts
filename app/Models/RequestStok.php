<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestStok extends Model
{
    protected $connection = 'pgsql_pusat';
    protected $table = 'request_stok';
    protected $fillable = ['buku_id', 'qty', 'catatan_cabang', 'status', 'cabang_id'];

    // Relasi ke Master Buku
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }

    public function stokPusat()
    {
        return $this->hasOne(StokGudangPusat::class, 'buku_id', 'buku_id');
    }

    public function cabang() {
        return $this->belongsTo(Cabang::class, 'cabang_id');
    }
}
