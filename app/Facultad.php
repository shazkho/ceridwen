<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Facultad
 * Representa a las facultades (modelo de Eloquent)
 *
 * @package App
 * @author  GeorgeShazkho <shazkho@gmail.com>
 * @version 0.1
 */
class Facultad extends Model
{
    /*
     * Se sobre escribe la variable 'table' para indicar el nombre que tendrá. Esto porque al usar el plural
     * en inglés quedaría 'facultads' en lugar de 'facultades'.
     */
    protected $table = 'facultades';
}
