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
        Schema::create('barangs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('kode_barang')->unique();
            $table->string('nama_barang');
            $table->uuid('id_kategori')->nullable();
            $table->json('atribute')->nullable();
            $table->uuid('id_brand')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->foreign('id_kategori')->references('id')->on('kategoris');
            $table->foreign('id_brand')->references('id')->on('brands');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
