<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class FormatosSeeder
 * Registra los formatos de archivo que se aceptarán inicialmente en el sistema.
 *
 * @author  GeorgeShazkho <shazkho@gmail.com>
 * @version 0.1
 */
class FormatosSeeder extends Seeder
{
    /**
     * Ejecuta los seeds para la base de datos.
     *
     * @return void
     */
    public function run()
    {
        // Lista de formatos admitidos inicialmente
        $formatos = [
            ['extension' => 'pdf',  'nombre' => 'adobe PDF'],
            ['extension' => 'doc',  'nombre' => 'documento de office'],
            ['extension' => 'docx', 'nombre' => 'documento de office'],
            ['extension' => 'ppt',  'nombre' => 'presentación de power point'],
            ['extension' => 'pptx', 'nombre' => 'presentación de power point'],
            ['extension' => 'txt',  'nombre' => 'archivo de texto'],
            ['extension' => 'rtf',  'nombre' => 'documento de texto con formato'],
            ['extension' => 'xls',  'nombre' => 'planilla de excel'],
            ['extension' => 'xlsx', 'nombre' => 'planilla de excel'],
            ['extension' => 'avi',  'nombre' => 'video AVI'],
            ['extension' => 'jpg',  'nombre' => 'imágen JPG'],
            ['extension' => 'png',  'nombre' => 'imágen PNG'],
            ['extension' => 'jpeg', 'nombre' => 'imágen JPEG'],
            ['extension' => 'gif',  'nombre' => 'imágen GIF'],
        ];
        // insertar en la base de datos, iterando sobre los formatos pre-definidos.
        foreach ($formatos as $formato) {
            DB::table('formatos')->insert([
                'extension' => $formato['extension'],
                'nombre'    => $formato['nombre'],
            ]);
        }
    }
}
