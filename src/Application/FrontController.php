<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 03/03/2018
 * Time: 01:59
 */

namespace Website\Application;


use Flight;
use Website\Application\Interfaces\ModelInterface;
use Website\Application\Interfaces\ControllerInterface;
use Website\Application\Interfaces\ViewInterface;

class FrontController
{

    protected $types = [
        TYPE_CONTROLLER => CONTROLLERS_FOLDER,
        TYPE_MODEL => MODELS_FOLDER,
        TYPE_VIEW => VIEWS_FOLDER
    ];

    public $payloads;

    public function __construct()
    {

        if ( Flight::has('route') == false )
        {

            throw new \ErrorException('Flight route request global constant not found');
        }
    }

    /**
     * @param string $controller
     * @param string $model
     * @param string $view
     * @param string $payload_identifier
     * @return \stdClass
     * @throws \ErrorException
     */

    public function getPayload( string $controller, string $model, string $view, string $payload_identifier="")
    {

        if ( $this->hasController( $controller ) == false || $this->hasModel( $model ) == false || $this->hasView( $view ) == false )
        {

            throw new \ErrorException('One of the MVC components does not exist');
        }

        $namespace = $this->getRealName( $this->getNameSpace( TYPE_MODEL ) , $model );
        $model = new $namespace;

        if ( $model instanceof ModelInterface == false )
        {

            throw new \ErrorException('Model is not in the correct interface');
        }

        $namespace = $this->getRealName( $this->getNameSpace( TYPE_VIEW ) , $view );
        $view = new $namespace( $model );

        if ( $view instanceof ViewInterface == false )
        {

            throw new \ErrorException('View is not in the correct interface');
        }

        $namespace = $this->getRealName( $this->getNameSpace( TYPE_CONTROLLER ) , $controller );
        $controller = new $namespace( $model );

        if ( $controller instanceof ControllerInterface == false )
        {

            throw new \ErrorException('Controller is not in the correct interface');
        }

        $payload = new \stdClass();
        $payload->model = $model;
        $payload->view = $view;
        $payload->controller = $controller;

        if ( $payload_identifier  !== "" )
        {

            if ( isset( $this->payloads[ $payload_identifier ] ) )
            {

                throw new \ErrorException('Payload ' . $payload_identifier . ' already exists');
            }

            $this->payloads[ $payload_identifier ] = $payload;
        }

        return $payload;
    }

    /**
     * @param $controller
     * @return bool
     * @throws \ErrorException
     */

    private function hasController( $controller )
    {

        if ( class_exists( $this->getRealName( $this->getNameSpace( TYPE_CONTROLLER ), $controller ) ) == false )
        {

            return false;
        }

        return true;
    }

    /**
     * @param $model
     * @return bool
     * @throws \ErrorException
     */

    private function hasModel( $model )
    {

        if ( class_exists( $this->getRealName( $this->getNameSpace( TYPE_MODEL ), $model ) ) == false )
        {

            return false;
        }

        return true;
    }

    /**
     * @param $view
     * @return bool
     * @throws \ErrorException
     */

    private function hasView( $view )
    {

        if ( class_exists( $this->getRealName( $this->getNameSpace(TYPE_VIEW ), $view ) ) == false )
        {

            return false;
        }

        return true;
    }

    /**
     * @param $namespace
     * @param $class
     * @return mixed
     * @throws \ErrorException
     */

    private function getRealName( $namespace, $class )
    {

        $real = $namespace . $class;

        if ( class_exists( $real ) == false )
        {

            throw new \ErrorException('Class ' . $real . ' does not exist');
        }

        return( $real );
    }

    /**
     * @param int $type
     * @return string
     * @throws \ErrorException
     */

    private function getNameSpace( $type=0 )
    {

        if ( $type > TYPE_VIEW || $type < 0 )
        {

            throw new \ErrorException();
        }

        if ( isset( $this->types[ $type ] ) == false )
        {

            throw new \ErrorException();
        }

        return( WEBSITE_APPLICATION_NAMESPACE . $this->types[ $type ] . '\\' );
    }
}