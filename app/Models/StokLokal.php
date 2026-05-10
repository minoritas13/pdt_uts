<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokLokal extends Model
{
    use HasFactory;
    
    protected $connection = 'pgsql_cabang';
    protected $table = 'stok_lokal';
    protected $fillable = ['buku_id', 'qty_tersedia'];
}
