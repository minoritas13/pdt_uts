<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MutasiGudangPusat extends Model
{
    use HasFactory;

    protected $connection = 'pgsql_pusat';
    protected $table = 'mutasi_gudang_pusat';
    protected $fillable = ['buku_id', 'jenis', 'qty', 'keterangan', 'waktu'];

    public function cabang() {
        return $this->belongsTo(Cabang::class, 'cabang_id');
    }
}
