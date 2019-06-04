<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class RegionesSeeder
 * Registra las regiones en las que la universidad existe actualmente.
 *
 * @author  GeorgeShazkho <shazkho@gmail.com>
 * @version 0.1
 */
class RegionesSeeder extends Seeder
{
    /**
     * Ejecuta los seeds para la base de datos.
     *
     * @return void
     */
    public function run()
    {
        // Lista de regiones para insertar en la base de datos (no cambian)
        $regiones = [
            ['numero' => 1, 'nombre' => 'tarapacá'],
            ['numero' => 2, 'nombre' => 'antofagasta'],
            ['numero' => 3, 'nombre' => 'atacama'],
            ['numero' => 4, 'nombre' => 'coquimbo'],
            ['numero' => 5, 'nombre' => 'valparaíso'],
            ['numero' => 6, 'nombre' => 'libertador general bernardo o\'higgins'],
            ['numero' => 7, 'nombre' => 'maule'],
            ['numero' => 8, 'nombre' => 'concepción'],
            ['numero' => 9, 'nombre' => 'la araucanía'],
            ['numero' => 10, 'nombre' => 'los lagos'],
            ['numero' => 11, 'nombre' => 'aysén del general carlos ibañez del campo'],
            ['numero' => 12, 'nombre' => 'magallanes y de la antártica chilena'],
            ['numero' => 13, 'nombre' => 'metropolitana de Santiago'],
            ['numero' => 14, 'nombre' => 'los ríos'],
            ['numero' => 15, 'nombre' => 'arica y parinacota'],
            ['numero' => 16, 'nombre' => 'ñuble'],
        ];
        // insertar en la base de datos, iterando sobre las regiones pre-definidas.
        foreach ($regiones as $region) {
            DB::table('regiones')->insert([
                'numero'    => $region['numero'],
                'nombre'    => $region['nombre'],
            ]);
        }
    }
}
