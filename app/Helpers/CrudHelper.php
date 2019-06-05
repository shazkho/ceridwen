<?php
namespace App\Helpers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

/**
 * Class CrudHelper
 * Provides functionality related to Shazkho's CRUD Plugin to be used on controllers.
 *
 * @package App\Helpers
 * @author  GeorgeShazkho<shazkho@gmail.com>
 * @version 0.2
 */
class CrudHelper
{

    /**
     * Calls for index view, as used in the context of generic CRUD generation.
     *
     * @param   Model   $model      The model representing an existing database table.
     * @param   null    $resource   The name of the resource (as shown in routes file).
     * @param   array   $options    An array with some parameters to modify some behaviour.
     * @return  Response    A properly constructed generic CRUD index view.
     *
     * @author  GeorgeShazkho<shazkho@gmail.com>
     * @version 0.2
     */
    public static function renderIndex(Model $model, $resource=null, $options=[])
    {
        // Fetching table name and columns
        $name = $model->getTable();
        $columns = Schema::getColumnListing($name);
        $data = $model::all();

        // Creating array with using columns and column names (will be filtered)
        $usingColumns = [];
        foreach($columns as $column){
            $usingColumns[$column] = $column;
        }

        // If $resource is not specified and title definition
        if($resource === null) {
            $resource = $name;
        }
        $title = 'CRUD :: Listing every ' . $resource . ' on database.';

        // Options processing
        if (array_key_exists('hide', $options)) {           // If hiding columns
            $usingColumns = self::hideColumns($usingColumns, $options['hide']);
        }
        elseif (array_key_exists('rename', $options)) {     // If renaming columns
            $usingColumns = self::renameColumns($usingColumns, $options['rename']);
        }
        elseif (array_key_exists('title', $options)) {      // If defining custom title
            $title = $options['title'];
        }
        $usingColumns = self::cleanColumns($usingColumns);

        // Returning CRUD index view
        return view('mantenedor.index', [
            'name' => $name,
            'data' => $data,
            'title'     => $title,
            'columns'   => $usingColumns,
            'resource'  => $resource,
        ]);
    }


    /**
     * Mark provided $hidden columns as 'null' renaming, which excludes the column from the columns on view.
     *
     * @param   array   $usingColumns   Table columns loaded from using table.
     * @param   array   $hide           List of table's columns to be hidden.
     * @return  array   Same input columns, but with $hide column names marked as null
     *
     * @author  GeorgeShazkho<shazkho@gmail.com>
     * @version 0.2
     */
    private static function hideColumns($usingColumns, $hide)
    {
        foreach ($hide as $column){
            if (array_key_exists($column, $usingColumns)) {
                $usingColumns[$column] = null;
            }
        }
        return $usingColumns;
    }


    /**
     * Cleans existing column names to most adequately fit it's usage as table headers. It replaces
     * underscore characters with spaces, and capitalizes first character.
     *
     * @param   array   $usingColumns   Table columns loaded from using table.
     * @return  mixed   Same input columns with clean names.
     *
     * @author  GeorgeShazkho<shazkho@gmail.com>
     * @version 0.2
     */
    private static function cleanColumns($usingColumns)
    {
        foreach ($usingColumns as $columnName => $columnAlias){
            if ($usingColumns[$columnName] !== null) {
                $usingColumns[$columnName] = str_replace('_', ' ', $usingColumns[$columnName]);
                $usingColumns[$columnName] = ucfirst($usingColumns[$columnName]);
            }
        }
        return $usingColumns;
    }


    /**
     * Renames desired columns as to be shown on view (index table). It only changes column aliases.
     *
     * @param   array   $usingColumns   Table columns loaded from using table.
     * @param   array   $rename         Table defining column name aliases.
     * @return  mixed   Same input table, but with aliases defined.
     *
     * @author  GeorgeShazkho<shazkho@gmail.com>
     * @version 0.1
     */
    private static function renameColumns($usingColumns, $rename)
    {
        foreach ($rename as $columnName => $columnNewName){
            if (array_key_exists($columnName, $usingColumns) && $usingColumns[$columnName] !== null) {
                $usingColumns[$columnName] = $rename[$columnName];
            }
        }
        return $usingColumns;
    }

}