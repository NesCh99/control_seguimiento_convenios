<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClasificacionsTable extends Migration
{
    /**
     * Migracion de la tabla V_CLASIFICACIONES
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
         * Crea la tabla V_CLASIFICACIONES
         */
        Schema::create('v_clasificaciones', function (Blueprint $table) {
            $table->engine = 'InnoDB'; //Habilitar InnoDB en la Base de Datos
            $table->id('idClasificacion'); //Clave primaria autoincremental
            /**
             * Definicion de atributos
             */
            $table->char('chaNombreClasificacion', 25);
            $table->timestamp('tstCreacionClasificacion')->nullable();
            $table->timestamp('tstModificacionClasificacion')->nullable();
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
         * Elimina la tabla V_CLASIFICACIONES
         */
        Schema::dropIfExists('v_clasificaciones');
    }
}
