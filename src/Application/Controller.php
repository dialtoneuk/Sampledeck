<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 04/03/2018
 * Time: 03:29
 */

namespace Website\Application;


use Website\Application\Interfaces\ModelInterface;

class Controller
{

    /**
     * @var ModelInterface
     */

    public $model;

    /**
     * Controller constructor.
     * @param ModelInterface $model
     */

    public function __construct( ModelInterface $model )
    {

        $this->model = $model;
    }

    /**
     * @param $message
     */

    public function addError( $message )
    {

        if ( $this->model->has('errors') == false )
        {

            $this->model->set('errors', [$message]);
            return;
        }

        $this->model->set('errors', $this->model->get('errors')[] = $message );
    }

    /**
     * @return mixed
     */

    public function getRequestMethod()
    {

        return( $_SERVER['REQUEST_METHOD'] );
    }

    /**
     *
     */

    public function cleanInput()
    {

        foreach ( $_POST as $key=>$value )
        {

            $_POST[ $key ] = strip_tags( $value );
        }
    }
}