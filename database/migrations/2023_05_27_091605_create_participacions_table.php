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
        Schema::create('participaciones', function (Blueprint $table) {
            $table->id('part_id');
            $table->integer('part_seccion_actual')->default(0); //0:Presentación
            $table->integer('part_secciones_total');
            $table->text('part_fechas')->nullable();
            $table->boolean('part_finalizada')->default(0);
            $table->unsignedBigInteger('part_acti_id');
            $table->unsignedBigInteger('part_usua_id');
            $table->foreign('part_acti_id')->references('acti_id')->on('actividades');
            $table->foreign('part_usua_id')->references('usua_id')->on('usuarios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participaciones');
    }
};
