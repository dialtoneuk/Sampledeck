<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 03/03/2018
 * Time: 02:18
 */

namespace Website\Application\Interfaces;


interface ControllerInterface
{

    /**
     * ControllerInterface constructor.
     *
     * @param ModelInterface $model
     */

    public function __construct( ModelInterface $model);

    /**
     * @param object $request
     *
     * @return mixed
     */

    public function controller( object $request );
}