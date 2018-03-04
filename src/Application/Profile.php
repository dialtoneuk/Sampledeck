<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 03/03/2018
 * Time: 04:13
 */

namespace Website\Application;


use Website\Sessions;

class Profile extends \stdClass
{

    public $data;
    public $sessions;

    /**
     * Profile constructor.
     * @param bool $requirelogin
     */

    public function __construct( bool $requirelogin=true )
    {

        $this->data = new \stdClass();
        $this->sessions = new Sessions();

        $this->setAcquireLogin( $requirelogin );
    }

    /**
     * @param bool $value
     */

    public function setAcquireLogin(bool $value )
    {

        $this->data->requirelogin = $value;
    }

    /**
     * @return bool
     */

    public function isLoggedIn()
    {

        if ( session_id() !== PHP_SESSION_ACTIVE )
        {

            return false;
        }

        if ( $this->sessions->valid( session_id() ) == false )
        {

            return false;
        }

        return true;
    }

    /**
     * @return \stdClass
     */

    public function getData()
    {

        return( $this->data );
    }

    /**
     * @param $name
     * @return mixed
     */

    public function __get($name)
    {

        return( $this->data->$name );
    }

    /**
     * @param $name
     * @param $value
     */

    public function __set($name, $value)
    {

        $this->data->$name = $value;
    }

    /**
     * @param $name
     * @return bool
     */

    public function __isset($name)
    {

        return ( isset( $this->data->$name ) );
    }
}