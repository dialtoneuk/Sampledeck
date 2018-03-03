<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 03/03/2018
 * Time: 02:19
 */

namespace Website\Application;


interface ModelInterface
{

    /**
     * @param $key
     * @param $value
     * @return mixed
     */

    public function set( $key, $value );

    /**
     * @param $key
     * @return mixed
     */

    public function get( $key );

    /**
     * @return mixed
     */

    public function model();
}