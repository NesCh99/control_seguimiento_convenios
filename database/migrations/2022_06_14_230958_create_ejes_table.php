<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEjesTable extends Migration
{
    /**
     * Migracion de la tabla V_EJES
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
         * Crea la tabla V_EJES
         */
        Schema::create('v_ejes', function (Blueprint $table) {
            $table->engine = 'InnoDB'; //Habilitar InnoDB en la Base de Datos
            $table->id('idEje');//Clave primaria autoincremental
            /**
             * Definicion de atributos
             */
            $table->char('chaNombreEje', 30);
            $table->timestamp('tstCreacionEje')->nullable();
            $table->timestamp('tstModificacionEje')->nullable();
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
         * Elimina la tabla V_EJES
         */
        Schema::dropIfExists('v_ejes');
    }
}
