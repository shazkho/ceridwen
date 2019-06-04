<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class FacultadesSeeder
 * Registra las facultades actualmente existentes en la universidad.
 *
 * @author  GeorgeShazkho <shazkho@gmail.com>
 * @version 0.1
 */
class FacultadesSeeder extends Seeder
{
    /**
     * Ejecuta los seeds para la base de datos.
     *
     * @return void
     */
    public function run()
    {
        // Lista de facultades para insertar en la base de datos (no cambian)
        $facultades = [
            [
                'nombre'        => 'Arquitectura, Construcción y Diseño',
                'codigo'        => 1,
                'ciudad_id'     => 1,
                'archivo_id'    => 1
            ], [
                'nombre'        => 'Ciencias',
                'codigo'        => 1,
                'ciudad_id'     => 1,
                'archivo_id'    => 1
            ], [
                'nombre'        => 'Ingeniería',
                'codigo'        => 1,
                'ciudad_id'     => 1,
                'archivo_id'    => 1
            ], [
                'nombre'        => 'Ciencias Empresariales',
                'codigo'        => 1,
                'ciudad_id'     => 1,
                'archivo_id'    => 1
            ], [
                'nombre'        => 'Ciencias de la Salud y de los Alimentos',
                'codigo'        => 1,
                'ciudad_id'     => 2,
                'archivo_id'    => 1
            ], [
                'nombre'        => 'Educación y Humanidades',
                'codigo'        => 1,
                'ciudad_id'     => 2,
                'archivo_id'    => 1
            ],
        ];
        // insertar en la base de datos, iterando sobre las facultades pre-definidas.
        foreach ($facultades as $facultad) {
            DB::table('facultades')->insert([
                'archivo_id'    => $facultad['archivo_id'],
                'ciudad_id'     => $facultad['ciudad_id'],
                'codigo'        => $facultad['codigo'],
                'nombre'        => $facultad['nombre'],
            ]);
        }
    }
}
