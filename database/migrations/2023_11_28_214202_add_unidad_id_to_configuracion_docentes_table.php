<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUnidadIdToConfiguracionDocentesTable extends Migration
{
    public function up()
    {
        Schema::table('configuracion_docentes', function (Blueprint $table) {
            // Asegúrate de que 'unidades' sea el nombre correcto de tu tabla de unidades
            $table->unsignedBigInteger('unidad_id')->nullable()->after('asignatura_id');
            $table->foreign('unidad_id')->references('id')->on('unidades')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('configuracion_docentes', function (Blueprint $table) {
            $table->dropForeign(['unidad_id']);
            $table->dropColumn('unidad_id');
        });
    }
}
