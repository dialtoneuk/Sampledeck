<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 17/03/2018
 * Time: 21:38
 */

namespace Website;

use Website\Database\Tables\Builds as Database;

class Builds
{

    /**
     * @var Database
     */

    protected $database;

    /**
     * Builds constructor.
     */

    public function __construct()
    {

        $this->database = new Database();
    }

    public function hasBuilds( $userid )
    {

        if ( $this->database->has('userid', $userid ) == false )
            return false;

        return true;
    }

    public function getBuilds( $userid )
    {

        return $this->database->get('userid', $userid );
    }

}