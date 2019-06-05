<?php

namespace App\Http\Controllers;

use App\Helpers\CrudHelper;
use Illuminate\Http\Request;
use App\Formato;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\View;

/**
 * Class FormatoController
 * Controlador para los formatos de archivo. Su implementación básica utiliza el Shazkho's CRUD Plugin
 * como mantenedor. Debe ser implementado como corresponda más adelante.
 *
 * @package App\Http\Controllers
 * @author  GeorgeShazkho<shazkho@gmail.com>
 * @version 0.1
 */
class FormatoController extends Controller
{
    /**
     * Muestra una lista con todos los registros para el recurso 'formatos'.
     *
     * @return  Response   Una vista mostrando todos los registros.
     *
     * @author  GeorgeShazkho<shazkho@gmail.com>
     * @version 0.1
     */
    public function index()
    {
        $crud = new CrudHelper();
        return $crud::renderIndex(new Formato, 'formatos', [
            'hide'      => ['created_at', 'updated_at'],
            'title'     => 'Título',
        ]);
    }

    /**
     * Muestra un formulario para crear un recurso 'formato'.
     *
     * @return  Response    Una vista con el formulario para crear el recurso.
     *
     * @author  GeorgeShazkho<shazkho@gmail.com>
     * @version 0.1
     */
    public function create()
    {
        return null;
    }

    /**
     * Almacena el nuevo 'formato' creado en la base de datos.
     *
     * @param Request $request La consulta POST con el 'formato'.
     * @return Response Una redirección a la lista de recursos (index).
     *
     * @author  GeorgeShazkho<shazkho@gmail.com>
     * @version 0.1
     */
    public function store(Request $request)
    {
        return null;
    }

    /**
     * Muestra el detalle para un 'formato'
     *
     * @param   int         $id El identificador (en la base de datos) del elemento a consultar.
     * @return  Response    Una vista con la información completa del 'formato'.
     *
     * @author  GeorgeShazkho<shazkho@gmail.com>
     * @version 0.1
     */
    public function show($id)
    {
        return null;
    }

    /**
     * Muestra un formulario para editar un 'formato' existente.
     *
     * @param   int         $id El identificador del formato a editar, en la base de datos.
     * @return  Response    Una vista con el formulario para modificar un 'formato'.
     *
     * @author  GeorgeShazkho<shazkho@gmail.com>
     * @version 0.1
     */
    public function edit($id)
    {
        return null;
    }

    /**
     * Actualiza el 'formato' modificado en la base de datos.
     *
     * @param   Request     $request    La solicitud con la información a actualizar (PUT).
     * @param   int         $id El identificador (en la base de datos) del 'formato' a modificar.
     * @return  Response    Una redirección a la vista con la lista de todos los registros (index).
     *
     * @author  GeorgeShazkho<shazkho@gmail.com>
     * @version 0.1
     */
    public function update(Request $request, $id)
    {
        return null;
    }

    /**
     * Elimina un registro desde la base de datos.
     *
     * @param   int         $id El identificador (en la base de datos) del 'formato' a eliminar.
     * @return  Response    Una redirección a la vista con la lista de todos los registros (index).
     *
     * @author  GeorgeShazkho<shazkho@gmail.com>
     * @version 0.1
     */
    public function destroy($id)
    {
        return null;
    }
}
