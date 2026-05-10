<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;
    
    protected $connection = 'pgsql_cabang';
    protected $table = 'detail_transaksi';
    protected $fillable = ['transaksi_id', 'buku_id', 'qty', 'harga_satuan', 'subtotal'];
}
