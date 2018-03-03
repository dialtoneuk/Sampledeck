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

    protected $sessions;

    public function __construct(bool $requirelogin = false)
    {

        $this->sessions = new Sessions();

        parent::__construct($requirelogin);
    }

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

                return false;
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