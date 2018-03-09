<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 03/03/2018
 * Time: 03:18
 */

namespace Website;

use Website\Database\Tables\Users as Table;

class Users
{

    /**
     * @var Table
     */

    protected $table;

    /**
     * Users constructor.
     */

    public function __construct()
    {

        $this->table = new Table();
    }

    /**
     * @param int $userid
     * @return mixed|null
     */

    public function get( $userid=0 )
    {

        return( $this->table->first('userid', $userid ) );
    }

    /**
     * @param $username
     * @return mixed|null
     */

    public function getByUsername( $username )
    {

        return( $this->table->first('username', $username ) );
    }

    /**
     * @param $username
     * @return bool
     */

    public function checkForUsername( $username )
    {

        return( $this->table->has('username', $username ) );
    }

    /**
     * @param $email
     * @return bool
     */

    public function checkForEmail( $email )
    {

        return( $this->table->has('email', $email ) );
    }
    /**
     * @param int $userid
     * @param array $array
     */

    public function edit( $userid=0, $array=[] )
    {

        $this->table->table()->where($userid, 0)->update( $array );
    }

    /**
     * @param $array
     * @return int
     */

    public function insert( $array )
    {

        return ( $this->table->insert( $array ) );
    }

    /**
     * @param int $userid
     * @return bool
     */

    public function exists( $userid=0 )
    {

        return( $this->table->has('userid', $userid ) );
    }

    /**
     * @return \Illuminate\Support\Collection
     */

    public function all()
    {

        return( $this->table->all() );
    }
}