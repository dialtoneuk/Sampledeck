<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 03/03/2018
 * Time: 04:25
 */

namespace Website\Application\Profiles;


use Website\Application\Interfaces\ProfileInterface;
use Website\Application\Profile;
use Website\Sessions;

class Session extends Profile implements ProfileInterface
{

    /**
     * @var Sessions
     */

    public $sessions;

    /**
     * Session constructor.
     */

    public function __construct()
    {

        $this->sessions = new Sessions();

        parent::__construct( false );
    }

    /**
     * @return bool
     */

    public function populate()
    {

        if ( session_status() !== PHP_SESSION_ACTIVE )
        {

            return false;
        }
        else
        {

            if ( $this->sessions->valid( session_id() ) == false )
            {

                $this->data->session = [
                    'status' => false
                ];
            }
            else
            {

                $session = $this->sessions->get( session_id() );

                $this->data->session = [
                    'sessionid' => session_id(),
                    'status'    => session_status(),
                    'logintime' => $session->logintime,
                    'userid'    => $session->userid
                ];
            }
        }
    }
}