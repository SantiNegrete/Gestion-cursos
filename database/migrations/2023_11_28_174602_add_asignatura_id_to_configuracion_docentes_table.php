<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAsignaturaIdToConfiguracionDocentesTable extends Migration
{
    public function up()
    {
        Schema::table('configuracion_docentes', function (Blueprint $table) {
            $table->unsignedBigInteger('asignatura_id')->after('tema_id');
            $table->foreign('asignatura_id')->references('id')->on('asignaturas');
        });
    }

    public function down()
    {
        Schema::table('configuracion_docentes', function (Blueprint $table) {
            $table->dropForeign(['asignatura_id']);
            $table->dropColumn('asignatura_id');
        });
    }
}

