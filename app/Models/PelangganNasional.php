<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PelangganNasional extends Model
{
    protected $connection = 'pusat'; 
    protected $table = 'pelanggan_nasional';
    protected $fillable = ['nama', 'asal_cabang'];
}
