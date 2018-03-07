<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 07/03/2018
 * Time: 02:35
 */

function console_out( string $message )
{

    echo( $message );
}

function getInput()
{

    return ( fopen ("php://stdin","r") );
}