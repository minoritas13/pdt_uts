<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelangganLokal extends Model
{
    use HasFactory;
    
    protected $connection = 'pgsql_cabang';
    protected $table = 'pelanggan_lokal';
    protected $fillable = ['nama', 'no_telp', 'poin'];
}
