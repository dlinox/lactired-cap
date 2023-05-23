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
        Schema::create('instructores', function (Blueprint $table) {
            $table->id('inst_id');
            $table->string('inst_nombre');
            $table->string('inst_apellido');
            $table->enum('inst_documento_tipo', ['DNI', 'RUC', 'CE'])->default('DNI');
            $table->char('inst_documento_nro', 12)->unique();
            $table->string('inst_email')->unique();
            $table->string('inst_password')->nullable();
            $table->boolean('inst_estado')->default(1);
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructores');
    }
};
