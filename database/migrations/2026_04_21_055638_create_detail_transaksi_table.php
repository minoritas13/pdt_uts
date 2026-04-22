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
        Schema::connection('cabang')->create('detail_transaksi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaksi_id');
            $table->unsignedBigInteger('buku_id'); // Relasi logis ke db_pusat.buku
            $table->integer('qty');
            $table->decimal('harga_satuan', 12, 2); // Disalin dari Pusat agar record harga tidak berubah jika harga master naik
            $table->decimal('subtotal', 12, 2);
            $table->timestamps();

            $table->foreign('transaksi_id')->references('id')->on('transaksi')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::connection('cabang')->dropIfExists('detail_transaksi');
    }
};
