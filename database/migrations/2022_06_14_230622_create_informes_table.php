<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformesTable extends Migration
{
     /**
     * Migracion de la tabla V_INFORMES
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
         * Crea la tabla V_INFORMES
         */
        Schema::create('v_informes', function (Blueprint $table) {
            $table->engine = 'InnoDB'; //Habilitar InnoDB en la Base de Datos
            $table->id('idInforme');//Clave primaria autoincremental
            $table->unsignedbigInteger('idConvenio');//Clave Foranea
            $table->text('texDescripcionInforme');
            $table->char('chaEstadoInforme', 10);
            $table->string('texUrlInforme')->nullable();
            $table->date('datFechaPresentacionInforme');
            $table->timestamp('tstCreacionInforme')->nullable();
            $table->timestamp('tstModificacionInforme')->nullable();
            //Definicion de la clave foranea
            $table->foreign('idConvenio')->references('idConvenio')->on('v_convenios')->onDelete("cascade");
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
        Schema::dropIfExists('v_informes');
    }
}
