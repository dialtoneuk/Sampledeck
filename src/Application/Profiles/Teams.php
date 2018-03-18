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
use Website\Teams as Manager;

class Teams extends Profile implements ProfileInterface
{

    public $teams;
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

        $this->teams = new Manager();
        $this->userid = $this->sessions->get( session_id() )->userid;

        return true;
    }

    /**
     * @return bool
     */

    public function populate()
    {

        if ( $this->isLoggedIn() == false )
            return false;

        if ( $this->teams->isInTeam( $this->userid ) == false )
            return false;

        $team = $this->teams->getUserTeam( $this->userid );

        if ( $this->teams->isAdmin( $team->teamid, $this->userid ) )
        {

            $group = ADMIN_GROUP;
        }
        else
        {

            $group = DEFAULT_GROUP;
        }

        $this->data->info = [
            'teamid' => $team->teamid,
            'owner'  => $team->userid,
            'name'   => $team->name,
            'description' => $team->description,
            'colour' => $team->colour,
            'group'  => $group
        ];
    }
}