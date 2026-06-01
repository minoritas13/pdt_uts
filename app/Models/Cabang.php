<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    use HasFactory;

    protected $connection = 'pgsql_pusat';
    protected $table = 'cabang';
    protected $fillable = ['kode_cabang', 'nama_cabang', 'lokasi'];

    public function users() {
        return $this->hasMany(User::class, 'cabang_id');
    }
}
