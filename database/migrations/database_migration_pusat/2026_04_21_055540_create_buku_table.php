<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::connection('pgsql_pusat')->create('buku', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kategori_id');
            $table->unsignedBigInteger('penerbit_id');
            $table->string('isbn')->unique();
            $table->string('judul');
            $table->string('penulis');
            $table->decimal('harga_nasional', 12, 2);
            $table->timestamps();
            $table->softDeletes();
            
            // Foreign key DALAM SATU database (Aman)
            $table->foreign('kategori_id')->references('id')->on('kategori');
            $table->foreign('penerbit_id')->references('id')->on('penerbit');
        });
    }

    public function down(): void
    {
        Schema::connection('pgsql_pusat')->dropIfExists('buku');
    }
};
