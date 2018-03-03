<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 03/03/2018
 * Time: 00:50
 */

namespace Website\IO;


class FileOperator
{

    /**
     * @param $file
     * @param bool $array
     * @return array|mixed
     * @throws \ErrorException
     */

    public static function readAsJson( $file, $array=false )
    {

        $file = file_get_contents( self::getRealPath( $file ) );

        if( empty( $file ) )
        {

            return [];
        }

        if ( $array )
        {

            $data = json_decode( $file, true );
        }
        else
        {

            $data = json_decode( $file );
        }

        if ( json_last_error() !== JSON_ERROR_NONE )
        {

            throw new \ErrorException( 'Json error: ' . json_last_error_msg() );
        }

        return $data;
    }

    /**
     * @param $file
     * @return string
     * @throws \ErrorException
     */

    private static function getRealPath( $file )
    {

        if ( defined('SAMPLEDECK_REALPATH') == false )
        {

            throw new \ErrorException();
        }

        return ( SAMPLEDECK_REALPATH . $file );
    }
}