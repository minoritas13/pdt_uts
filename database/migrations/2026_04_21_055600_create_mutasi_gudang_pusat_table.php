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
        Schema::connection('pusat')->create('mutasi_gudang_pusat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('buku_id');
            $table->enum('jenis', ['MASUK', 'KELUAR']);
            $table->integer('qty');
            $table->string('keterangan'); // Misal: "Dari Penerbit" atau "Kirim ke Cabang BDO"
            $table->timestamp('waktu')->useCurrent();
            $table->timestamps();

            $table->foreign('buku_id')->references('id')->on('buku');
        });
    }

    public function down(): void
    {
        Schema::connection('pusat')->dropIfExists('mutasi_gudang_pusat');
    }
};
