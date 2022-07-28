<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConveniosResolucionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
             * Tabla muchos a muchos
             */
       /*  Schema::create('v_convenios_resoluciones', function (Blueprint $table) {
            
            $table->unsignedBigInteger('idResolucion');
            $table->unsignedBigInteger('idConvenio');

            //Definicion de las claves foraneaS
            $table->foreign('idResolucion')->references('idResolucion')->on('v_resoluciones')->onDelete("cascade");
            $table->foreign('idConvenio')->references('idConvenio')->on('v_convenios')->onDelete("cascade");


        }); */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       /*  Schema::dropIfExists('v_convenios_resoluciones'); */
    }
}
