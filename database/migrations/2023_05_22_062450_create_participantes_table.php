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
        Schema::create('participantes', function (Blueprint $table) {
            $table->id('part_id');
            //$table->foreignId('curs_id')->constrained('curs_cursos');
            //$table->foreignId('empl_id')->constrained('empl_empleados');
            //$table->date('part_fecha_inscripcion');
            //$table->string('part_estado')->default('inscrito');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participantes');
    }
};
