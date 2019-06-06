<?php
namespace App\Helpers;

use DB;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

/**
 * Class CrudHelper
 * Provides functionality related to Shazkho's CRUD Plugin to be used on controllers.
 *
 * @package App\Helpers
 * @author  GeorgeShazkho<shazkho@gmail.com>
 * @version 0.3
 */
class CrudHelper
{

    /**
     * Calls for index view, as used in the context of generic CRUD generation.
     *
     * @param   string      $modelName  The name of the model representing desired database table.
     * @param   array       $options    An array with some parameters to modify some behaviour.
     * @return  Response    A properly constructed generic CRUD index view.
     *
     * @author  GeorgeShazkho<shazkho@gmail.com>
     * @version 0.4
     */
    public static function renderIndex($modelName, $options=[])
    {
        // Creating CrudTable object and HTML title
        $table = new CrudTable($modelName);
        $title = 'CRUD :: Listing every ' . strtolower($modelName) . ' on database.';

        // Processing options
        $table->processColumns($options);
        if (array_key_exists('title', $options)) {      // If defining custom title
            $title = $options['title'];
        }

        // Returning CRUD index view
        return view('mantenedor.index', [
            'title'     => $title,
            'name'      => $table->getTableName(),
            'columns'   => $table->getColumns(),
            'data'      => $table->getAllData(),
        ]);
    }


    /**
     * Calls for create view, as used in the context of generic CRUD generation.
     *
     * @param   string  $modelName  The name of the model representing desired database table
     * @param   array   $options    An array with some parameters to modify some behaviour.
     * @return  Response    A properly constructed generic CRUD index view.
     *
     * @author  GeorgeShazkho<shazkho@gmail.com>
     * @version 0.2
     */
    public static function renderCreate($modelName, $options=[])
    {
        // Creating CrudTable object and HTML title
        $table = new CrudTable($modelName);
        $title = 'CRUD :: Creating a new element in \'' . strtolower($modelName) . '\'.';

        // Processing options
        $table->processColumns($options);
        if (array_key_exists('title', $options)) {      // If defining custom title
            $title = $options['title'];
        }

        // Returning CRUD create view
        return view('mantenedor.create', [
            'title'     => $title,
            'name'      => $table->getTableName(),
            'columns'   => $table->getColumns(),
        ]);
    }


    /**
     * Calls for store function, as used in the context of generic CRUD generation.
     *
     * @param   string      $modelName  The name of the model representing desired database table
     * @param   Request     $request    Request response from 'create' form
     * @return  Response    Redirection to index view.
     *
     * @author  GeorgeShazkho<shazkho@gmail.com>
     * @version 0.2
     */
    public static function store($modelName, $request)
    {
        $table = new CrudTable($modelName);

        foreach ($table->getColumns() as $columnName => $columnOptions) {
            if ($columnOptions['writable']) {
                $table->model->$columnName = $request->$columnName;
            }
        }
        $table->model->save();
        return redirect(route($table->getTableName() . '.index'))->with('message', 'Added register into \'' . $table->getTableName() . '\' table.');
    }


}