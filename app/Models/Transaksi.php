<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $connection = 'pgsql_cabang';
    protected $table = 'transaksi';
    protected $fillable = ['no_struk', 'pelanggan_id', 'total', 'status_pembayaran', 'tipe_pesanan' ,'bukti_bayar'];

    public function details()
    {
        return $this->hasMany(DetailTransaksi::class);
    }
}
