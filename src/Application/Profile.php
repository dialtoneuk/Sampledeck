<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 03/03/2018
 * Time: 04:13
 */

namespace Website\Application;

class Profile extends \stdClass
{

    protected $data;

    public function __construct( bool $requirelogin=true )
    {

        $this->data = new \stdClass();

        $this->setAcquireLogin( $requirelogin );
    }

    public function setAcquireLogin(bool $value )
    {

        $this->data->requirelogin = $value;
    }

    public function getData()
    {

        return( $this->data );
    }

    public function __get($name)
    {

        return( $this->data->$name );
    }

    public function __set($name, $value)
    {

        $this->data->$name = $value;
    }

    public function __isset($name)
    {

        return ( isset( $this->data->$name ) );
    }
}