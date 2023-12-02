<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTemasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('temas', function (Blueprint $table) {
            // Añadir las claves foráneas
            $table->foreignId('practica_id')->nullable()->constrained('practicas');
            $table->foreignId('calendario_id')->nullable()->constrained('calendario');
            $table->foreignId('instrumentacion_id')->nullable()->constrained('instrumentacion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('temas', function (Blueprint $table) {
            // Eliminar las claves foráneas y las columnas
            $table->dropForeign(['calendario_id']);
            $table->dropForeign(['instrumentacion_id']);
            $table->dropColumn('calendario_id');
            $table->dropColumn('instrumentacion_id');
        });
    }
}
