<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class CiudadesSeeder
 * Registra las ciudades en las que la universidad existe actualmente.
 *
 * @author  GeorgeShazkho <shazkho@gmail.com>
 * @version 0.1
 */
class CiudadesSeeder extends Seeder
{
    /**
     * Ejecuta los seeds para la base de datos.
     *
     * @return void
     */
    public function run()
    {
        // Lista de ciudades para insertar en la base de datos (no cambian)
        $ciudades = [
            [
                'region_id' => 8,
                'nombre'    => 'concepcion',
            ], [
                'region_id' => 16,
                'nombre'    => 'chillan',
            ]
        ];
        // insertar en la base de datos, iterando sobre las ciudades pre-definidas.
        foreach ($ciudades as $ciudad) {
            DB::table('ciudades')->insert([
                'region_id'    => $ciudad['region_id'],
                'nombre'        => $ciudad['nombre'],
            ]);
        }
    }
}
