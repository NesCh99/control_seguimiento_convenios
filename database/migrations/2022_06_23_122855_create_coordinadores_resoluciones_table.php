<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoordinadoresResolucionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('v_coordinadores_resoluciones', function (Blueprint $table) {
            $table->unsignedbigInteger('idResolucion');//Clave Foranea
            $table->unsignedbigInteger('idCoordinador');//Clave Foranea

            //Definicion de las claves foranea
            $table->foreign('idResolucion')->references('idResolucion')->on('v_resoluciones')->onDelete("cascade");
            $table->foreign('idCoordinador')->references('idCoordinador')->on('v_coordinadores')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('v_coordinadores_resoluciones');
    }
}
