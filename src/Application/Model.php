<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 04/03/2018
 * Time: 03:36
 */

namespace Website\Application;


class Model
{

    /**
     * @var \stdClass
     */

    public $model;

    /**
     * Model constructor.
     */

    public function __construct()
    {

        $this->model = new \stdClass();
    }

    /**
     * @param $key
     * @param $value
     */

    public function set($key, $value)
    {

        $this->model->$key = $value;
    }

    /**
     * @param $key
     * @return mixed
     */

    public function get($key)
    {
        return( $this->model->$key );
    }

    /**
     * @return \stdClass
     */

    public function model()
    {
        return( $this->model );
    }

    /**
     * @return mixed
     * @throws \ErrorException
     */

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