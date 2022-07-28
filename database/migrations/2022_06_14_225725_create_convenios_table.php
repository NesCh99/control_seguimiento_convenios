<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConveniosTable extends Migration
{
    /**
     * Migracion de la tabla V_CONVENIOS
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
         * Crea la tabla V_CONVENIOS
         */
        Schema::create('v_convenios', function (Blueprint $table) {
            $table->engine = 'InnoDB'; //Habilitar InnoDB en la Base de Datos
            $table->id('idConvenio');//Clave primaria autoincremental
            $table->unsignedbigInteger('idClasificacion');//Clave Foranea
            $table->unsignedbigInteger('idResolucion');//Clave Foranea
            
            /**
             * Definicion de atributos
             */
            $table->text('texNombreConvenio', 500);
            $table->text('texObjetoConvenio', 500);
            $table->date('datFechaInicioConvenio');
            $table->date('datFechaFinConvenio')->nullable();
            $table->char('chaEstadoConvenio',10);
            $table->string('texUrlConvenio')->nullable();
            $table->timestamp('tstCreacionConvenio')->nullable();
            $table->timestamp('tstModificacionConvenio')->nullable();
            //Definicion de la clave foranea
            $table->foreign('idClasificacion')->references('idClasificacion')->on('v_clasificaciones')->onDelete("cascade");
            $table->foreign('idResolucion')->references('idResolucion')->on('v_resoluciones')->onDelete("cascade");
            
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
         * Elimina la tabla V_CONVENIOS
         */
        Schema::dropIfExists('v_convenios');
    }
}

