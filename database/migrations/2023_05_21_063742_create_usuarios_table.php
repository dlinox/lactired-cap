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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('usua_id');
            $table->string('usua_nombre', 120);
            $table->string('usua_apellido', 120);
            $table->enum('usua_documento_tipo', ['DNI', 'RUC', 'CE'])->default('DNI');
            $table->char('usua_documento_nro', 12)->unique();
            $table->string('usua_email')->unique();
            $table->string('usua_password');
            $table->boolean('usua_estado')->default(1);
            //$table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
