<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokGudangPusat extends Model
{
    use HasFactory;
    
    protected $connection = 'pusat';
    protected $table = 'stok_gudang_pusat';
    protected $fillable = ['buku_id', 'qty_tersedia'];
}
