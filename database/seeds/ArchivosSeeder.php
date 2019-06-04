<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class CiudadesSeeder
 * Registra un único archivo, con propósito de pruebas al desarrollar.
 *
 * @author  GeorgeShazkho <shazkho@gmail.com>
 * @version 0.1
 */
class ArchivosSeeder extends Seeder
{
    /**
     * Ejecuta los seeds para la base de datos.
     *
     * @return void
     */
    public function run()
    {
        DB::table('archivos')->insert([
            'formato_id'    => 1,
            'nombre'        => 'Archivo de ejemplo',
            'ruta'          => 'archivo_ejemplo.pdf',
            'tamano'        => '300000',
        ]);
    }
}
