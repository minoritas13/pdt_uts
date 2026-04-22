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
        Schema::connection('cabang')->create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('no_struk')->unique();
            $table->unsignedBigInteger('pelanggan_id')->nullable(); // Boleh null jika bukan member
            $table->decimal('total', 12, 2);
            // Status sinkronisasi sangat penting untuk antrean event (Eventual Consistency)
            $table->enum('status_sinkronisasi', ['PENDING', 'SUKSES'])->default('PENDING');
            $table->timestamps();

            $table->foreign('pelanggan_id')->references('id')->on('pelanggan_lokal');
        });
    }

    public function down(): void
    {
        Schema::connection('cabang')->dropIfExists('transaksi');
    }
};
