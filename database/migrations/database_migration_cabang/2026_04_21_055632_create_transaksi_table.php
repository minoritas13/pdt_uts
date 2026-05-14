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
        Schema::connection('pgsql_cabang')->create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('no_struk')->unique();
            $table->unsignedBigInteger('pelanggan_id')->nullable(); // Boleh null jika bukan member
            $table->decimal('total', 12, 2);

            // Status sinkronisasi sangat penting untuk antrean event (Eventual Consistency)
            $table->enum('status_pembayaran', ['PENDING', 'SUKSES'])->default('PENDING');

            $table->enum('tipe_pesanan', ['ONLINE', 'OFFLINE'])->default('OFLINE');

            $table->timestamps();
            $table->string('bukti_bayar')->nullable();

            $table->foreign('pelanggan_id')->references('id')->on('pelanggan_lokal');
        });
    }

    public function down(): void
    {
        Schema::connection('pgsql_cabang')->dropIfExists('transaksi');
    }
};
