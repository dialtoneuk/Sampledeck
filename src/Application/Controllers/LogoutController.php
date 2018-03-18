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
use Website\Sessions;
use Flight;

class LogoutController extends Controller implements ControllerInterface
{

    /**
     * @param object $request
     * @return bool|mixed
     * @throws \ErrorException
     */

    public function controller( object $request )
    {

        if ( $request->method == 'GET' )
        {
            $this->sessions = Flight::sessions();

            if ( $this->sessions->valid( session_id() ) == false )
            {

                Flight::redirect( '/' );
                return true;
            }

            $this->sessions->delete( session_id() );

            session_regenerate_id( true );

            session_destroy();

            Flight::redirect( '/' );
            return true;
        }
        else
        {

            return false;
        }
    }
}