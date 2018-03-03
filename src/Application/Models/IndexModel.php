<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 03/03/2018
 * Time: 02:26
 */

namespace Website\Application\Models;


use Website\Application\ModelInterface;

class IndexModel implements ModelInterface
{

    public $model;

    public function __construct()
    {

        $this->model = new \stdClass();
    }

    public function set($key, $value)
    {

        $this->model->$key = $value;
    }

    public function get($key)
    {
        return( $this->model->$key );
    }

    public function model()
    {
        return( $this->model );
    }

    public function toArray()
    {

        if ( empty( func_get_args() ) )
        {

            throw new \ErrorException();
        }

        $array = json_decode( json_encode( func_get_args()[0] ), true );

        if ( json_last_error() !== JSON_ERROR_NONE )
        {

            throw new \ErrorException( json_last_error_msg() );
        }

        return( $array );
    }
}