<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 03/03/2018
 * Time: 04:22
 */

namespace Website\Application;


use Website\IO\Crawler;
use Website\Sessions;

class ProfilesController
{

    /**
     * @var Crawler
     */

    protected $crawler;

    /**
     * ProfilesController constructor.
     */

    public function __construct()
    {

        $this->crawler = new Crawler( $this->getRealPath() );
    }

    /**
     * @param $profiles
     * @return array
     */

    public function process( $profiles )
    {

        $data = [];
        $this->session = new Sessions();

        foreach ( $profiles as $key=>$profile )
        {

            if ( isset( $profile->requirelogin ) )
            {

                if ( $profile->requirelogin == true )
                {

                    if ( session_status() !== PHP_SESSION_ACTIVE )
                    {

                        continue;
                    }

                    if ( $this->session->valid( session_id() ) == false )
                    {

                        continue;
                    }
                }
            }

            $profile->populate();

            if ( empty( $profile->data ) )
            {

                continue;
            }

            $data[ strtolower( $key ) ] = $profile->data;
        }

        return $data;
    }

    /**
     * @return bool|\stdClass
     * @throws \ErrorException
     */

    public function get()
    {

        $profiles = $this->getProfilePaths();

        if ( empty( $profiles ) )
        {

            return false;
        }

        $classes = new \stdClass();

        foreach ( $profiles as $value )
        {

            if ( class_exists( $this->getNamespace( $value ) ) == false )
            {

                throw new \ErrorException('Invalid class: ' . $this->getNamespace( $value ) );
            }

            $namespace = $this->getNamespace( $value );
            $class = new $namespace;

            if ( isset( $classes->$value ) )
            {

                continue;
            }

            $classes->$value = $class;
        }

        return $classes;
    }

    /**
     * @return array|null
     */

    private function getProfilePaths()
    {

        $files = $this->crawler->getInDirectory();

        if ( empty( $files ) )
        {

            return null;
        }

        foreach ( $files as $key=>$file )
        {

            $explode = explode(DIRECTORY, $file );

            if ( empty( $explode ) )
            {

                $files[ $key ] = $this->deleteExt( last( $explode ) );
                continue;
            }

            $files[ $key ] = $this->deleteExt( last( $explode ) );
        }

        return $files;
    }

    /**
     * @param $file
     * @return mixed
     */

    private function deleteExt( $file )
    {

        $explode = explode('.', $file );

        return( $explode[0] );
    }

    /**
     * @param $class
     * @return string
     */

    private function getNamespace( $class )
    {

        return( WEBSITE_APPLICATION_NAMESPACE . PROFILES_FOLDER . '\\' . $class );
    }

    /**
     * @return string
     */

    private function getRealPath()
    {

        return ( 'src/Application/' . PROFILES_FOLDER . '/');
    }
}