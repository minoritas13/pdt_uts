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
        Schema::connection('pgsql_pusat')->create('mutasi_gudang_pusat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('buku_id');
            $table->enum('jenis', ['MASUK', 'KELUAR']);
            $table->integer('qty');
            $table->unsignedBigInteger('cabang_id')->nullable();
            $table->string('keterangan');
            $table->timestamp('waktu')->useCurrent();
            $table->timestamps();

            $table->foreign('buku_id')->references('id')->on('buku');
        });
    }

    public function down(): void
    {
        Schema::connection('pgsql_pusat')->dropIfExists('mutasi_gudang_pusat');
    }
};
