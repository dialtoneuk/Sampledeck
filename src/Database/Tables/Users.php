<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 03/03/2018
 * Time: 01:20
 */

namespace Website\Database\Tables;


use Website\Database\Table;

class Users extends Table
{

    /**
     * Users constructor.
     * @param string $table_name
     */

    public function __construct($table_name = "users")
    {

        parent::__construct($table_name);
    }

    /**
     * @param $column
     * @param $value
     * @return \Illuminate\Support\Collection
     */

    public function get( $column, $value )
    {

        $array = [
            $column => $value
        ];

        return( $this->table()->where( $array )->get() );
    }

    /**
     * @param $column
     * @param $value
     * @return mixed|null
     */

    public function first( $column, $value )
    {

        if ( $this->has( $column, $value ) == false )
        {

            return null;
        }

        $array = [
            $column => $value
        ];

        $result = $this->table()->where( $array )->get();

        if ( $result->isEmpty() )
        {

            return null;
        }

        return( $result[0] );
    }

    /**
     * @param $column
     * @param $value
     * @return bool
     */

    public function has( $column, $value )
    {

        $array = [
            $column => $value
        ];

        return( $this->table()->where( $array )->get()->isEmpty() );
    }

    /**
     * @param $array
     * @return int
     */

    public function insert( $array )
    {

        return( $this->table()->insertGetId( $array ) );
    }

    /**
     * @param $userid
     * @throws \ErrorException
     */

    public function delete( $userid )
    {

        if ( $this->has( 'userid', $userid ) == false )
        {

            throw new \ErrorException();
        }

        $this->table()->where( 'userid', $userid )->delete();
    }
}