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

    protected $databases = [];

    /**
     * Teams constructor.
     */

    public function __construct()
    {

        $this->databases = [
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

        return( $this->getTeamDatabase()->has("teamid", $teamid ) );
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

        $result = $this->getMembersDatabase()->get('teamid', $teamid );

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

        return ( $this->getMembersDatabase()->hasUser( $teamid, $userid ));
    }

    /**
     * Returns true if the user is in a team
     *
     * @param $userid
     *
     * @return bool
     */

    public function isInTeam( $userid )
    {

        if ( $this->getTeamDatabase()->has('userid', $userid ) == false )
            return false;

        return true;
    }

    /**
     * @param $teamid
     * @param $userid
     * @return bool
     */

    public function isAdmin( $teamid, $userid )
    {

        $result = $this->getMembersDatabase()->getUser( $teamid, $userid );

        if ( empty( $result ) )
            return false;

        if ( $result->group == ADMIN_GROUP )
            return true;

        return false;
    }

    /**
     * @return \Illuminate\Support\Collection
     */

    public function getTeams()
    {

        return $this->getTeamDatabase()->all();
    }

    /**
     * @param $userid
     * @return \Illuminate\Support\Collection
     */

    public function getUserTeam( $userid )
    {

        return $this->getTeamDatabase()->first('userid', $userid );
    }

    /**
     * @param $teamid
     * @return \Illuminate\Support\Collection|null
     */

    public function getBuilds( $teamid )
    {

        $result = $this->getBuildsDatabase()->get('teamid', $teamid );

        if ( $result->isEmpty() )
            return null;

        return $result;
    }

    /**
     * @return DatabaseTeam
     */

    private function getTeamDatabase()
    {

        return ( $this->databases['team'] );
    }

    /**
     * @return DatabaseTeamMember
     */

    private function getMembersDatabase()
    {

        return ( $this->databases['members'] );
    }

    /**
     * @return DatabaseTeamBuilds
     */

    private function getBuildsDatabase()
    {

        return ( $this->databases['builds'] );
    }
}