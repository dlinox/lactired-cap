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
        Schema::create('actividades', function (Blueprint $table) {
            $table->id('acti_id');
            $table->string('acti_tema')->unique();
            $table->text('acti_descripcion')->nullable();
            $table->date('acti_fecha_inicio')->nullable();
            $table->date('acti_fecha_fin')->nullable();
            $table->enum('acti_modalidad', ['VIRTUAL', 'PRESENCIAL'])->default('VIRTUAL');
            $table->char('acti_anio', 4)->nullable();
            $table->boolean('acti_estado')->default(1);

            $table->unsignedBigInteger('acti_tipo_id');
            $table->unsignedBigInteger('acti_area_id');
            $table->unsignedBigInteger('acti_inst_id')->nullable();
            $table->unsignedBigInteger('acti_exam_id')->nullable();
            $table->foreign('acti_tipo_id')->references('tipo_id')->on('tipos');
            $table->foreign('acti_area_id')->references('area_id')->on('areas');
            $table->foreign('acti_inst_id')->references('inst_id')->on('instructores');
            $table->foreign('acti_exam_id')->references('exam_id')->on('examenes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actividads');
    }
};
