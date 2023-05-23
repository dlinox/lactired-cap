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
        Schema::create('secciones', function (Blueprint $table) {
            $table->id('secc_id');
            $table->string('secc_nombre', 255);
            $table->float('secc_nota_aprobatoria')->nullable();
            $table->unsignedBigInteger('exam_id');
            $table->unique(['secc_nombre', 'exam_id']);
            $table->foreign('exam_id')->references('exam_id')->on('examenes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('secciones');
    }
};
