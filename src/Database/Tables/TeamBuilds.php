<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 09/03/2018
 * Time: 01:51
 */

namespace Website\Database\Tables;


use Website\Database\Table;

class TeamBuilds extends Table
{

    /**
     * TeamBuilds constructor.
     * @param string $table_name
     */

    public function __construct($table_name = 'team_builds')
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
            return null;

        $array = [
            $column => $value
        ];

        $result = $this->table()->where( $array )->get();

        if ( $result->isEmpty() )
            return null;

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

        $result = $this->table()->where( $array )->get();

        if ( $result->isNotEmpty() )
            return true;

        return false;
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
     * @param $buildid
     */

    public function delete( $buildid )
    {

        $this->table()->where('buildid', $buildid )->delete();
    }
}