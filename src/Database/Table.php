<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 03/03/2018
 * Time: 01:09
 */

namespace Website\Database;


use Flight;

class Table
{

    /**
     * @var \Illuminate\Database\Connection
     */

    public $dbconnection;

    /**
     * @var null|string
     */

    public $table_name;

    /**
     * Table constructor.
     * @param null $table_name
     */

    public function __construct( $table_name=null )
    {

        $this->dbconnection = Flight::dbconnection()->get();

        if ( $table_name == null )
            $table_name = get_called_class();

        $this->table_name = $table_name;
    }

    /**
     * @return int
     */

    public function count()
    {

        return( $this->dbconnection->table( $this->table_name )->count() );
    }

    /**
     * @return \Illuminate\Support\Collection
     */

    public function all()
    {

        return( $this->dbconnection->table( $this->table_name )->get() );
    }

    /**
     * @return bool
     */

    public function exists()
    {

        return ( $this->dbconnection->table( $this->table_name )->exists() );
    }

    /**
     * @return \Illuminate\Database\Query\Builder
     */

    public function table()
    {

        return ( $this->dbconnection->table( $this->table_name ) );
    }
}