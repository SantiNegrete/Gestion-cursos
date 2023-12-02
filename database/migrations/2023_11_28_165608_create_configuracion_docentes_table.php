<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('configuracion_docentes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('docente_id'); 
            $table->unsignedBigInteger('tema_id'); 
            $table->unsignedBigInteger('calendario_id')->nullable(); 
            $table->unsignedBigInteger('instrumentacion_id')->nullable(); 

            $table->timestamps();

            // Claves foráneas
            $table->foreign('docente_id')->references('id')->on('usuarios'); 
            $table->foreign('tema_id')->references('id')->on('temas'); 
            $table->foreign('calendario_id')->references('id')->on('calendario'); 
            $table->foreign('instrumentacion_id')->references('id')->on('instrumentacion'); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('configuracion_docentes');
    }
};
