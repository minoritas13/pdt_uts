<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    
    protected $connection = 'cabang';
    protected $table = 'transaksi';
    protected $fillable = ['no_struk', 'pelanggan_id', 'total', 'status_sinkronisasi'];

    public function details()
    {
        return $this->hasMany(DetailTransaksi::class);
    }
}
