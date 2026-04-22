<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MutasiStokLokal extends Model
{
    use HasFactory;
    
    protected $connection = 'cabang';
    protected $table = 'mutasi_stok_lokal';
    protected $fillable = ['buku_id', 'jenis', 'qty', 'keterangan', 'waktu'];
}
