<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConveniosEjesTable extends Migration
{
    /**
     * Migracion de la tabla V_CONVENIOS_EJES
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
         * Crea la tabla V_CONVENIOS_EJES
         */
        Schema::create('v_convenios_ejes', function (Blueprint $table) {
            $table->unsignedbigInteger('idConvenio');//Clave Foranea
            $table->unsignedbigInteger('idEje');//Clave Foranea
            //Definicion de las claves foraneaS
            $table->foreign('idConvenio')->references('idConvenio')->on('v_convenios')->onDelete("cascade");
            $table->foreign('idEje')->references('idEje')->on('v_ejes')->onDelete("cascade");
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
         * Elimina la tabla V_CONVENIOS_EJES
         */
        Schema::dropIfExists('v_convenios_ejes');
    }
}
