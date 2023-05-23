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
        Schema::create('preguntas', function (Blueprint $table) {
            $table->id('preg_id');
            $table->string('preg_enunciado', 255);
            $table->decimal('preg_valor', 10, 2)->nullable();
            $table->unsignedBigInteger('secc_id');
            $table->foreign('secc_id')->references('secc_id')->on('secciones');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preguntas');
    }
};
