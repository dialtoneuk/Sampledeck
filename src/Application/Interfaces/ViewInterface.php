<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 03/03/2018
 * Time: 02:20
 */

namespace Website\Application\Interfaces;


interface ViewInterface
{

    /**
     * ViewInterface constructor.
     *
     * @param ModelInterface $model
     */

    public function __construct( ModelInterface $model );

    /**
     * @return array
     */

    public function view();
}