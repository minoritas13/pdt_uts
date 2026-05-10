<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerbit extends Model
{
    use HasFactory;
    
    protected $connection = 'pgsql_pusat';
    protected $table = 'penerbit';
    protected $fillable = ['nama_penerbit', 'kota'];

    public function buku(){

        return $this->hasMany(Buku::class);
    
    }
}
