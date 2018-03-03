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

    protected $users;

    public $userid;

    /**
     * User constructor.
     * @param $userid
     */

    public function __construct( $userid )
    {

        $this->users = new Users();

        if ( $this->users->exists( $userid ) == false )
        {

            return false;
        }

        $this->userid = $userid;

        return parent::__construct( true );
    }

    public function populate()
    {

        $user = $this->users->get( $this->userid );

        $this->data->user = [
            'userid'    => $this->userid,
            'username'  => $user->username,
            'email'     => $user->email
        ];
    }
}