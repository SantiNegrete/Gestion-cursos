<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeTemaIdNullableInConfiguracionDocentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('configuracion_docentes', function (Blueprint $table) {
            $table->unsignedBigInteger('tema_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('configuracion_docentes', function (Blueprint $table) {
            $table->unsignedBigInteger('tema_id')->nullable(false)->change();
        });
    }
}

