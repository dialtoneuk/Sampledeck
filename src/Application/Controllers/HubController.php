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
use Website\Application\Interfaces\ModelInterface;
use Website\Builds;
use Flight;
use Website\Teams;

class HubController extends Controller implements ControllerInterface
{

    /**
     * @var Teams
     */

    protected $teams;

    /**
     * @var Builds
     */

    protected $builds;

    /**
     * HubController constructor.
     * @param ModelInterface $model
     */

    public function __construct(ModelInterface $model)
    {

        $this->teams = new Teams();
        $this->builds = new Builds();

        parent::__construct($model);
    }

    /**
     * @param object $request
     * @return bool|mixed
     * @throws \ErrorException
     */

    public function controller( object $request )
    {

        $this->sessions = Flight::sessions();

        if ( $this->sessions->valid( session_id() ) == false )
        {

            Flight::redirect( '/' );
            return true;
        }

        if ( $request->method == 'GET' )
        {

            $userid = $this->sessions->get( session_id() )->userid;

            if ( empty( $userid ) )
                throw new \ErrorException();

            if ( $this->teams->isInTeam( $userid ) )
            {

                $this->model->team( $this->teams->getUserTeam( $userid ) );
            }

            if ( $this->builds->hasBuilds( $userid ) )
            {

                $this->model->builds( $this->builds->getBuilds( $userid )->reverse() );
            }

            return true;
        }
        else
        {

            return true;
        }
    }
}