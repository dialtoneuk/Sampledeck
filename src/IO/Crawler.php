<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 03/03/2018
 * Time: 22:17
 */

namespace Website\IO;


use Website\IO\FileOperator;

class Crawler
{

    protected $path;

    public function __construct( $path="" )
    {

        if ( file_exists( $this->getRealPath( $path ) ) == false )
        {

            return false;
        }
        else
        {

            if ( is_dir( $this->getRealPath( $path ) ) == false )
            {

                return false;
            }
        }

        $this->path = $path;

        return true;
    }

    public function getInDirectory( $prefix=".php")
    {

        $files = glob( $this->getRealPath( $this->path ) . "*" . $prefix );

        if ( empty( $files ) )
        {

            return null;
        }

        return $files;
    }

    private function getRealPath( $path )
    {

        if ( substr( $path, -1) !== '/' )
        {

            $path .= '/';
        }

        return ( WEBSITE_REALPATH . $path );
    }
}