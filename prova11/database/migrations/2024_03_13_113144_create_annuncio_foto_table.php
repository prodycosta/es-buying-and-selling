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
        Schema::create('annuncio_foto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('annuncio_id');
            $table->unsignedBigInteger('foto_id');
            $table->timestamps();

            $table->foreign('annuncio_id')->references('id')->on('annuncios')->onDelete('cascade');
            $table->foreign('foto_id')->references('id')->on('foto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annuncio_foto');
    }
};
