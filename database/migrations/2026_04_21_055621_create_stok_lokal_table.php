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
        Schema::connection('cabang')->create('stok_lokal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('buku_id'); // Relasi logis ke db_pusat.buku
            $table->integer('qty_tersedia')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::connection('cabang')->dropIfExists('stok_lokal');
    }
};
