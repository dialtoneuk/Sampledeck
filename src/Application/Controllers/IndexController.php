<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 03/03/2018
 * Time: 02:17
 */

namespace Website\Application\Controllers;

use Website\Application\ControllerInterface;
use Website\Application\ModelInterface;

class IndexController implements ControllerInterface
{

    protected $model;

    public function __construct(ModelInterface $model)
    {

        $this->model = $model;
    }

    public function controller( object $request )
    {

        if ( $request->method == 'GET' )
        {

            if ( empty( $_GET ) == false )
            {

                if ( isset( $_GET['message'] ) )
                {

                    $this->model->set('message', $_GET['message'] );
                }
            }
        }
    }
}