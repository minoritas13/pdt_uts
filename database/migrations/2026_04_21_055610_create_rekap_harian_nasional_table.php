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
        Schema::connection('pusat')->create('rekap_harian_nasional', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cabang_id');
            $table->date('tanggal');
            $table->integer('total_transaksi')->default(0);
            $table->decimal('total_pendapatan', 15, 2)->default(0);
            $table->timestamps();

            $table->foreign('cabang_id')->references('id')->on('cabang');
        });
    }

    public function down(): void
    {
        Schema::connection('pusat')->dropIfExists('rekap_harian_nasional');
    }
};
