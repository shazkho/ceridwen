<?php


namespace App\Helpers;

use DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CrudTable
 *
 * Represents a table from database, but to be processed in the context of Shazkho's CRUD Helper.
 *
 * @package App\Helpers
 * @author  GeorgeShazkho<shazkho@gmail.com>
 * @version 0.2
 */
class CrudTable
{

    /**
     * @var Model
     */
    public $model;
    /**
     * @var string
     */
    private $name;
    /**
     * @var array
     */
    private $columns;


    /**
     * CrudTable constructor. Initializes object using model name.
     *
     * @param   string          $modelName  The name of the model, as string.
     * @param   null|integer    $id         Id of the current editing record.
     *
     * @author  GeorgeShazkho<shazkho@gmail.com>
     * @version 0.2
     */
    public function __construct($modelName, $id=null)
    {
        $modelClass = sprintf('\App\%s', $modelName);
        if($id === null) {
            $this->model = new $modelClass();
        } else {
            $this->model = $modelClass::find($id);
        }
        $this->name = $this->model->getTable();
        $this->columns = $this->getColumnsFromDatabase($this->name);
    }

    /*
     * -------------------------
     * COLUMN-RELATED FUNCTIONS
     * -------------------------
     */

    /**
     * Fetches all columns obtained by describing table (SQL describe instruction). Columns retrieved
     * are reconstructed to simplify notation.
     *
     * @param   string  $modelName  The name of the model, as string.
     * @return  array   Database columns as array (reconstructed).
     *
     * @author  GeorgeShazkho<shazkho@gmail.com>
     * @version 0.3
     */
    private function getColumnsFromDatabase($modelName)
    {
        $rawColumns = DB::select('describe ' . $modelName);
        $columns = [];
        foreach($rawColumns as $rawColumn) {
            $columns[$rawColumn->Field] = [
                'key'   => $rawColumn->Key,
                'alias' => false,
                'type'  => $this->getColumnType($rawColumn->Type),
                'show'  => true,
                'writable'  => $this->isWritableColumn($rawColumn),
            ];
        }
        return $columns;
    }


    /**
     * Determines the type of a column from raw type as defined in the database. The purpose is to
     * infer the kind of input field must be used when constructing creation and edition form.
     *
     * @param   string  $rawType    The literal raw type obtained describing the table.
     * @return  string  The type of the field, as to be used in Bootstrap form fields.
     *
     * @author  GeorgeShazkho<shazkho@gmail.com>
     * @version 0.2
     */
    private static function getColumnType($rawType)
    {
        if(substr($rawType,0, 7) == 'varchar'){
            return 'text';
        }
        elseif(substr($rawType,0, 3) == 'int'){
            return 'number';
        }
        return 'text';
    }


    /**
     * Processes column array to reflect changes, as defined in $processingOptions. Available
     * option as of version 0.1 are:
     *      - 'hide':   Hides provided columns. Parameter example:
     *          [$hideThis, $hideThat, ...]
     *      - 'rename': Sets aliases to columns. Parameter example:
     *          ['column1DatabaseName' => 'column1Alias', 'column2DatabaseName' => 'column2Alias', ...]
     * After processing columns, ones with no alias will be cleaned.
     *
     * @param   array   $options    Processing options, as described above.
     *
     * @author  GeorgeShazkho<shazkho@gmail.com>
     * @version 0.1
     */
    public function processColumns($options)
    {
        // Processing 'hide' option
        if(array_key_exists('hide', $options)) {
            foreach ($options['hide'] as $hideMe) {
                $this->hideColumn($hideMe);
            }
        }
        // Processing 'rename' option
        if(array_key_exists('rename', $options)) {
            foreach ($options['rename'] as $columnName => $columnAlias) {
                $this->renameColumn($columnName, $columnAlias);
            }
        }
        // Cleaning all rows (only updates columns with no alias)
        foreach ($this->columns as $columnName => $columnOptions) {
            $this->cleanColumn($columnName);
        }
    }


    /**
     * Sets a column as 'not shown'. 'Not shown' columns will be passed to the view, but won't be displayed
     * on any auto-generated table nor form. 'Not showing' a column means to define it's 'show' option as false.
     * This function updates instance columns (do not return).
     *
     * @param   string  $columnToHide   The name of the column to be hidden.
     *
     * @author  GeorgeShazkho<shazkho@gmail.com>
     * @version 0.3
     */
    private function hideColumn($columnToHide)
    {
        if(array_key_exists($columnToHide, $this->columns)) {
            $this->columns[$columnToHide]['show'] = false;
        }
    }


    /**
     * Defines an alias for any column. Columns are shown (in views) as defined alias (if defined).
     * It only changes column aliases. This function updates instance columns (do not return).
     *
     * @param   string  $columnName     The name of the table to be aliased.
     * @param   array   $columnAlias    The name of the table that will be displayed on views.
     *
     * @author  GeorgeShazkho<shazkho@gmail.com>
     * @version 0.3
     */
    private function renameColumn($columnName, $columnAlias)
    {
        if(array_key_exists($columnName, $this->columns)) {
            $this->columns[$columnName]['alias'] = $columnAlias;
        }
    }


    /**
     * Cleans the name of any column. This is meant to 'prettify' column names which will not be aliased.
     * This function replaces any 'underscore' with spaces, and capitalizes first character on table's name.
     * This function updates instance columns (do not return).
     *
     * @param   string  $columnName The name of the column to be cleaned.
     *
     * @author  GeorgeShazkho<shazkho@gmail.com>
     * @version 0.6
     */
    private function cleanColumn($columnName)
    {
        if(array_key_exists($columnName, $this->columns)) {
            if($this->columns[$columnName]['alias'] === false) {
                $this->columns[$columnName]['alias'] = str_replace('_', ' ', $columnName);
                $this->columns[$columnName]['alias'] = ucfirst($this->columns[$columnName]['alias']);
            }
        }
    }


    /*
     * -------------------------
     * GETTERS
     * -------------------------
     */

    /**
     * Retrieves records from database. This is intended to be used on any view.
     *
     * @param   null|integer        $id An identifier to find a certain row.
     * @return  Collection|Model[]  A collection of all entries on pre-defined database table (from model).
     *
     * @author  GeorgeShazkho<shazkho@gmail.com>
     * @version 0.2
     */
    public function getData($id=null)
    {
        if($id !== null) {
            return $this->model->find($id);
        }
        return $this->model::all();
    }


    /**
     * Retrieves the name of current table.
     *
     * @return  string  The name of currently loaded table.
     *
     * @author  GeorgeShazkho<shazkho@gmail.com>
     * @version 0.1
     */
    public function getTableName()
    {
        return $this->name;
    }


    /**
     * Retrieves the table columns. Any processing must be done before.
     *
     * @return  array   An array with columns.
     *
     * @author  GeorgeShazkho<shazkho@gmail.com>
     * @version 0.1
     */
    public function getColumns()
    {
        return $this->columns;
    }


    /**
     * Retrieves table columns which are writable, excluding indexes and timestamp columns. This function
     * is intended to be used in 'create' and 'update' views.
     *
     * @param   array   $allColumns All columns defined for current database table.
     * @return  array   Only writable columns.
     *
     * @author  GeorgeShazkho<shazkho@gmail.com>
     * @version 0.2
     */
    public function getWritableColumns($allColumns)
    {
        // Empty array to store writable columns
        $writableColumns = [];
        // Iterate over all provided columns
        foreach ($allColumns as $column => $options) {
            if($options['writable']) {
                $writableColumns[$column] = $options;
            }
        }
        return $writableColumns;
    }


    /**
     * Determines if a rawColumn is writable.
     *
     * @param   mixed   $rawColumn  Column to be analyzed, as raw column from database
     * @return  bool    True if column is writable. False if not.
     *
     * @author  GeorgeShazkho<shazkho@gmail.com>
     * @version 0.1
     */
    private function isWritableColumn($rawColumn)
    {
        // Determine if column is key or timestamp
        $isKey = $rawColumn->Key != "";
        $isTimestamp = in_array($rawColumn->Field, ['created_at', 'updated_at']);
        // If not, adding column as writable.
        if(!$isKey && !$isTimestamp) {
            return true;
        }
        return false;
    }

}