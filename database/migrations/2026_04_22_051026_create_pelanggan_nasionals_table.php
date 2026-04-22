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
        // WAJIB ditambahkan connection('pusat')
        Schema::connection('pusat')->create('pelanggan_nasional', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('asal_cabang');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::connection('pusat')->dropIfExists('pelanggan_nasional');
    }
};
