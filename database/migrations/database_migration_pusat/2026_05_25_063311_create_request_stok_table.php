<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('pgsql_pusat')->create('request_stok', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('buku_id');
            $table->integer('qty');
            $table->string('catatan_cabang')->nullable();
            $table->unsignedBigInteger('cabang_id');
            $table->enum('status', ['PENDING', 'DIKIRIM', 'DITOLAK'])->default('PENDING');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::connection('pgsql_pusat')->dropIfExists('request_stok');
    }
};
