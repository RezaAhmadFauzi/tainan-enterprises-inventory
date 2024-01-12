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
        Schema::table('barang_masuks', function (Blueprint $table) {
            $table->uuid('id_kategori')->nullable();
            $table->json('atribut')->nullable();
            $table->uuid('kode_barang_masuk')->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('barang_masuks', function (Blueprint $table) {
            $table->dropColumn([
                'id_kategori',
                'atribut',
                'kode_barang_masuk'
            ]);
        });
    }
};
