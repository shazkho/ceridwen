<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateArchivosTable
 * Define la tabla en la BD donde se registran los archivos que se han subido al sistema.
 *
 * @author  GeorgeShazkho <shazkho@gmail.com>
 * @version 0.1
 */
class CreateArchivosTable extends Migration
{
    /**
     * Ejecuta las migraciones.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archivos', function (Blueprint $table) {
            // Columnas
            $table->bigIncrements('id');
            $table->unsignedBigInteger('formato_id');
            $table->string('nombre');
            $table->string('ruta');
            $table->integer('tamano');
            $table->timestamps();
            // Llaves
            $table->foreign('formato_id')->references('id')->on('formatos');
        });
    }

    /**
     * Revierte las migraciones.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('archivos');
    }
}
