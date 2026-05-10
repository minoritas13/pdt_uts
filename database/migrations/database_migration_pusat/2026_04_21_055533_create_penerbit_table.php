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
        Schema::connection('pgsql_pusat')->create('penerbit', function (Blueprint $table) {
            $table->id();
            $table->string('nama_penerbit');
            $table->string('kota')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::connection('pgsql_pusat')->dropIfExists('penerbit');
    }
};
