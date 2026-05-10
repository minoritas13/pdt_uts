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
        Schema::connection('pgsql_pusat')->create('stok_gudang_pusat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('buku_id');
            $table->integer('qty_tersedia')->default(0);
            $table->timestamps();

            $table->foreign('buku_id')->references('id')->on('buku');
        });
    }

    public function down(): void
    {
        Schema::connection('pgsql_pusat')->dropIfExists('stok_gudang_pusat');
    }
};
