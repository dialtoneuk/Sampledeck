<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 03/03/2018
 * Time: 02:17
 */

namespace Website\Application\Controllers;


use Website\Application\Controller;
use Website\Application\Interfaces\ControllerInterface;

class IndexController extends Controller implements ControllerInterface
{

    /**
     * @param object $request
     * @return mixed|void
     */

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