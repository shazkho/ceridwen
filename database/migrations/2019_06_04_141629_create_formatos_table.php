<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateFormatosTable
 * Define la tabla en la BD donde se registran los tipos de archivo reconocidos por el sistema.
 *
 * @author  GeorgeShazkho <shazkho@gmail.com>
 * @version 0.1
 */
class CreateFormatosTable extends Migration
{
    /**
     * Ejecuta las migraciones.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formatos', function (Blueprint $table) {
            // Columnas
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('extension');
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
        Schema::dropIfExists('formatos');
    }
}
