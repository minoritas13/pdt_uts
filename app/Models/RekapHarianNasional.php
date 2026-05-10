<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapHarianNasional extends Model
{
    use HasFactory;
    
    protected $connection = 'pgsql_pusat';
    protected $table = 'rekap_harian_nasional';
    protected $fillable = ['cabang_id', 'tanggal', 'total_transaksi', 'total_pendapatan'];
}
