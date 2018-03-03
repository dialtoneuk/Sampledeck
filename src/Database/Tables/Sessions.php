<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 03/03/2018
 * Time: 01:27
 */

namespace Website\Database\Tables;


use Website\Database\Table;

class Sessions extends Table
{

    /**
     * Sessions constructor.
     * @param string $table_name
     */

    public function __construct($table_name = 'WEBSITE_sessions')
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

        return( $this->table()->where( $array )->get()[0] );
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
     * @param $sessionid
     * @throws \ErrorException
     */

    public function delete( $sessionid )
    {

        if ( $this->has('sessionid', $sessionid ) == false )
        {

            throw new \ErrorException();
        }

        $this->table()->where('sessionid', $sessionid )->delete();
    }
}