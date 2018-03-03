<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 03/03/2018
 * Time: 01:30
 */

namespace Website\Application;


use Website\IO\FileOperator as FileSystem;

class Routes
{

    /**
     * @var array
     */

    protected $routes;

    /**
     * Routes constructor.
     * @param array $routes
     * @throws \ErrorException
     */

    public function __construct( $routes=[] )
    {

        if ( $routes == [] )
        {

            $this->routes = $this->readRoutes();
        }
        else
        {

            $this->routes = $routes;
        }
    }

    /**
     * @return array
     */

    public function get()
    {

        return $this->routes;
    }

    /**
     * @param $route
     *
     * @return bool
     */

    public function has( $route )
    {

        if ( isset( $this->routes[ $route ] ) == false )
        {

            return false;
        }

        return true;
    }

    /**
     * @return array|mixed
     *
     * @throws \ErrorException
     */

    private function readRoutes()
    {

        if ( defined('SAMPLEDECK_ROUTESFILE') == false )
        {

            throw new \ErrorException();
        }

        $data = FileSystem::readAsJson( SAMPLEDECK_ROUTESFILE, true );

        if ( empty( $data ) )
        {

            throw new \ErrorException();
        }

        return $data;
    }
}