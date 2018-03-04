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

class Session extends Profile implements ProfileInterface
{

    /**
     * Session constructor.
     */

    public function __construct()
    {

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

        if ( $this->sessions->valid( session_id() ) )
        {

            $session = $this->sessions->get( session_id() );

            $this->data->session = [
                'sessionid' => session_id(),
                'active'    => true,
                'logintime' => $session->logintime,
                'userid'    => $session->userid
            ];
        }
        else
        {

            $this->data->session = [
                'active' => false
            ];
        }
    }
}