<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCiudadesTable
 * Define la tabla en la BD donde se registran las ciudades en las que la universidad existe.
 *
 * @author  GeorgeShazkho <shazkho@gmail.com>
 * @version 0.1
 */
class CreateCiudadesTable extends Migration
{
    /**
     * Ejecuta las migraciones.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ciudades', function (Blueprint $table) {
            // Columnas
            $table->bigIncrements('id');
            $table->unsignedBigInteger('region_id');
            $table->string('nombre');
            $table->timestamps();
            // Llaves
            $table->foreign('region_id')->references('id')->on('regiones');
        });
    }

    /**
     * Revierte las migraciones.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ciudades');
    }
}
