<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 03/03/2018
 * Time: 04:17
 */

namespace Website\Application\Profiles;


use Website\Application\Interfaces\ProfileInterface;
use Website\Application\Profile;
use Website\Users;

class User extends Profile implements ProfileInterface
{

    public $users;
    public $userid;

    /**
     * User constructor.
     * @throws \ErrorException
     */

    public function __construct()
    {

        parent::__construct( true );

        if ( $this->isLoggedIn() == false )
            return false;

        $this->users = new Users();
        $this->userid = $this->sessions->get( session_id() )->userid;

        if ( $this->users->exists( $this->userid ) == false )
        {

            throw new \ErrorException();
        }

        return true;
    }

    /**
     * @return bool
     */

    public function populate()
    {

        if ( $this->isLoggedIn() == false )
            return false;

        $user = $this->users->get( $this->userid );

        $this->data->info = [
            'userid'    => $this->userid,
            'username'  => $user->username,
            'group'     => $user->group,
            'email'     => $user->email,
            'colour'     => $user->colour
        ];
    }
}