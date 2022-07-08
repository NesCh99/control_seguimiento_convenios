<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResolucionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('v_resoluciones', function (Blueprint $table) {
            $table->id('idResolucion');//PK
            $table->char('chaNombreResolucion', 50);
            $table->string('texObjetoResolucion');
            $table->smallInteger('sinTipoResolucion');
            $table->string('texUrlResolucion')->nullable();
            $table->timestamp('tstCreacionResolucion')->nullable();
            $table->timestamp('tstModificacionResolucion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resoluciones');
    }
}
