<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 03/03/2018
 * Time: 02:19
 */

namespace Website\Application\Interfaces;


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
     * @param $key
     * @return bool
     */

    public function has( $key );

    /**
     * @return mixed
     */

    public function model();
}