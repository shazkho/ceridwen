<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateRegionesTable
 * Define la tabla en la BD donde se registran las regiones en las que la universidad existe.
 *
 * @author  GeorgeShazkho <shazkho@gmail.com>
 * @version 0.1
 */
class CreateRegionesTable extends Migration
{
    /**
     * Ejecuta las migraciones.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regiones', function (Blueprint $table) {
            // Columnas
            $table->bigIncrements('id');
            $table->integer('numero');
            $table->string('nombre');
            $table->timestamps();
        });
    }

    /**
     * Revierte las migraciones.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regiones');
    }
}
