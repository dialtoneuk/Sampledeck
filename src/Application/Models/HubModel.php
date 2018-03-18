<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 03/03/2018
 * Time: 02:26
 */

namespace Website\Application\Models;


use Website\Application\Interfaces\ModelInterface;
use Website\Application\Model;

class HubModel extends Model implements ModelInterface
{

    /**
     * IndexModel constructor.
     */

    public function __construct()
    {

        parent::__construct();
    }

    /**
     * @param $builds
     */

    public function builds( $builds )
    {

        $this->set('builds', $builds );
    }

    /**
     * @param $team
     */

    public function team( $team )
    {

        $this->set('team', $team );
    }
}