<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDependenciasTable extends Migration
{
   /**
     * Migracion de la tabla V_DEPENDENCIAS
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
         * Crea la tabla V_DEPENDENCIAS
         */
        Schema::create('v_dependencias', function (Blueprint $table) {
            $table->engine = 'InnoDB'; //Habilitar InnoDB en la Base de Datos
            $table->id('idDependencia');//Clave primaria autoincremental
            /**
             * Definicion de atributos
             */
            $table->string('vchNombreDependencia'); //String en reemplazo de varchar
            $table->timestamp('tstCreacionDependencia')->nullable();
            $table->timestamp('tstModificacionDependencia')->nullable();
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
         * Elimina la tabla V_DEPENDENCIAS
         */
        Schema::dropIfExists('v_dependencias');
    }
}
