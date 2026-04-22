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
        Schema::connection('cabang')->create('mutasi_stok_lokal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('buku_id'); // Relasi logis ke db_pusat.buku
            $table->enum('jenis', ['MASUK', 'KELUAR']);
            $table->integer('qty');
            $table->string('keterangan'); // Misal: "Kiriman Pusat" atau "Terjual Struk #123"
            $table->timestamp('waktu')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::connection('cabang')->dropIfExists('mutasi_stok_lokal');
    }
};
