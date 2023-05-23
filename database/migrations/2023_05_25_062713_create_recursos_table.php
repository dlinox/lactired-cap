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
        Schema::create('recursos', function (Blueprint $table) {
            $table->id('recu_id');
            $table->string('recu_nombre', 100);
            $table->string('recu_descripcion', 255)->nullable();
            $table->string('recu_tipo', 15)->nullable();
            $table->text('recu_url')->nullable();
            $table->boolean('recu_estado')->default(1);
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
        Schema::dropIfExists('recursos');
    }
};
