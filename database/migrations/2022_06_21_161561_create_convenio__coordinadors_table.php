<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConvenioCoordinadorsTable extends Migration
{
    /**
     * Migracion de la tabla V_CONVENIOS_COORDINADORES
     * 
     * Ejecutar cuando se vaya a implementar el sistema con el comando
     * 
     * php artisan migrate
     *
     * @return void
     */
    public function up()
    {
        /**
         * Crea la tabla V_CONVENIOS_COORDINADORES
         */
        Schema::create('v_convenios_coordinadores', function (Blueprint $table) {
            $table->unsignedbigInteger('idConvenio');//Clave Foranea
            $table->unsignedbigInteger('idCoordinador');//Clave Foranea
            /**
             * Definicion de atributos
             */
            $table->char('chaEstadoCoordinador', 15);
            //Definicion de las claves foranea
            $table->foreign('idConvenio')->references('idConvenio')->on('v_convenios')->onDelete("cascade");
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
        /**
         * Elimina la tabla V_CONVENIOS_COORDINADORES
         */
        Schema::dropIfExists('v_convenios_coordinadores');
    }
}
