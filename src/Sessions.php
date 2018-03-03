<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 03/03/2018
 * Time: 03:25
 */

namespace Website;

use Website\Database\Tables\Sessions as Database;

class Sessions
{

    /**
     * @var Database
     */

    protected $database;

    /**
     * Sessions constructor.
     */

    public function __construct()
    {

        $this->database = new Database();
    }

    /**
     * @param $sessionid
     * @return bool
     */

    public function valid( $sessionid )
    {

        return ( $this->database->has('sessionid', $sessionid ) );
    }

    /**
     * @param $sessionid
     * @return mixed|null
     */

    public function get( $sessionid )
    {

        return( $this->database->first('sessionid', $sessionid ) );
    }

    /**
     * @param int $userid
     * @return \Illuminate\Support\Collection
     */

    public function findByUser( $userid=0 )
    {

        return( $this->database->get('userid', $userid ) );
    }

    /**
     * @param $sessionid
     * @param array $array
     */

    public function update( $sessionid, $array=[] )
    {

        $this->database->table()->where( 'sessionid', $sessionid )->update( $array );
    }

    /**
     * @param array $array
     */

    public function insert( $array=[] )
    {

        $this->database->insert( $array );
    }

    /**
     * @param $sessionid
     * @throws \ErrorException
     */

    public function delete( $sessionid )
    {

        return( $this->database->delete( $sessionid ) );
    }
}