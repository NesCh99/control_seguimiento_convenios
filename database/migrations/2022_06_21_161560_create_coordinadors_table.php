<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoordinadorsTable extends Migration
{
    /**
     * Migracion de la tabla V_COORDINADORES
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
         * Crea la tabla V_COORDINADORES
         */
        Schema::create('v_coordinadores', function (Blueprint $table) {
            $table->engine = 'InnoDB'; //Habilitar InnoDB en la Base de Datos
            $table->id('idCoordinador');//Clave primaria autoincremental
            $table->unsignedbigInteger('idDependencia');//Clave Foranea
            /**
             * Definicion de atributos
             */
            $table->char('chaNombreCoordinador', 50)->nullable();
            $table->char('chaTituloCoordinador', 10)->nullable();
            $table->char('chaCargoCoordinador', 50);
            $table->char('chaCelularCoordinador', 10)->nullable();
            $table->timestamp('tstCreacionCoordinador')->nullable();
            $table->timestamp('tstModificacionCoordinador')->nullable();
            //Definicion de las claves foraneas
            $table->foreign('idDependencia')->references('idDependencia')->on('v_dependencias')->onDelete("cascade");
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
         * Elimina la tabla V_COORDINADORES
         */
        Schema::dropIfExists('v_coordinadores');
    }
}
