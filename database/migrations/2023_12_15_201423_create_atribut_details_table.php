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
        Schema::create('atribut_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_atribut');
            $table->string('value');
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->foreign('id_atribut')->references('id')->on('atributs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atribut_details');
    }
};
