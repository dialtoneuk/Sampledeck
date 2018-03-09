<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 09/03/2018
 * Time: 01:56
 */

namespace Website;

use Illuminate\Database\Eloquent\Collection;
use Website\Database\Tables\Team as DatabaseTeam;
use Website\Database\Tables\TeamMembers as DatabaseTeamMember;
use Website\Database\Tables\TeamBuilds as DatabaseTeamBuilds;

class Teams
{

    /**
     * @var array
     */

    protected $database = [];

    public function __construct()
    {

        $this->database = [
            'team'      => new DatabaseTeam(),
            'members'   => new DatabaseTeamMember(),
            'builds'    => new DatabaseTeamBuilds()
        ];
    }

    /**
     * @param $teamid
     * @return mixed
     */

    public function exists( $teamid )
    {

        return( $this->database['team']->has("teamid", $teamid ) );
    }

    /**
     * @param $teamid
     * @return bool
     */

    public function hasMembers( $teamid )
    {

        /**
         * @var $result Collection
         */

        $result = $this->database['members']->get('teamid', $teamid );

        if ( $result->isEmpty() )
            return false;

        return true;
    }

    /**
     * @param $teamid
     * @param $userid
     * @return mixed
     */

    public function isMember( $teamid, $userid )
    {

        return ( $this->database['members']->hasUser( $teamid, $userid ));
    }

    /**
     * @param $teamid
     * @param $userid
     * @return bool
     */

    public function isAdmin( $teamid, $userid )
    {

        $result = $this->database['members']->getUser( $teamid, $userid );

        if ( empty( $result ) )
            return false;

        if ( $result->group == 'admin' )
            return true;

        return false;
    }

    /**
     * @param $teamid
     * @return Collection|null

     */
    public function getBuilds( $teamid )
    {

        /**
         * @var $result Collection
         */

        $result = $this->database['builds']->get('teamid', $teamid );

        if ( $result->isEmpty() )
            return null;

        return $result;
    }
}