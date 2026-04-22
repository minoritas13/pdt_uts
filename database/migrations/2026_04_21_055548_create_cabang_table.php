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
        Schema::connection('pusat')->create('cabang', function (Blueprint $table) {
            $table->id();
            $table->string('kode_cabang')->unique();
            $table->string('nama_cabang');
            $table->text('lokasi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::connection('pusat')->dropIfExists('cabang');
    }
};
