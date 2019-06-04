<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateFacultadesTable
 * Define la tabla en la BD donde se registran las facultades de la universidad.
 *
 * @author  GeorgeShazkho <shazkho@gmail.com>
 * @version 0.1
 */
class CreateFacultadesTable extends Migration
{
    /**
     * Ejecuta las migraciones.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facultades', function (Blueprint $table) {
            // Columnas
            $table->bigIncrements('id');
            $table->unsignedBigInteger('archivo_id');
            $table->unsignedBigInteger('ciudad_id');
            $table->integer('codigo');
            $table->string('nombre');
            $table->timestamps();
            //Llaves
            $table->foreign('archivo_id')->references('id')->on('archivos');
            $table->foreign('ciudad_id')->references('id')->on('ciudades');
        });
    }

    /**
     * Revierte las migraciones.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facultades');
    }
}
