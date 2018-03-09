<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 03/03/2018
 * Time: 00:46
 */

namespace Website\Database;


use Website\IO\FileOperator as FileSystem;
use Illuminate\Database\Capsule\Manager as Database;

class Connection
{

    protected $capsule;
    protected $database_framework;
    protected $connection_credentials;

    private $mergers = [
                'collation' => 'utf8_unicode_ci',
                'prefix' => '',
                'charset' => 'utf8'
            ];

    /**
     * Connection constructor.
     * @param bool $auto
     * @param bool $catch_exceptions
     * @throws \Error
     * @throws \ErrorException
     */

    public function __construct( $auto=true, $catch_exceptions=false )
    {

        $this->database_framework = new Database();

        if ( $auto )
        {

            $this->connection_credentials = $this->getConnectionCredentials();

            if ( $catch_exceptions )
            {

                try
                {

                    $this->setConnection();
                }
                catch (\ErrorException $error )
                {

                    return false;
                }
            }
            else
            {

                $this->setConnection();
            }
        }
    }

    /**
     * @return \Illuminate\Database\Connection;
     */

    public function get()
    {

        return( $this->capsule );
    }

    /**
     * @param array $connection_credentials
     * @param bool $set_variable
     * @return bool
     * @throws \Error
     * @throws \ErrorException
     */

    public function setConnection( $connection_credentials = [], $set_variable=true )
    {

        if ( $connection_credentials == [] )
        {

            $connection_credentials = $this->connection_credentials;
        }
        else
        {

            if ( $this->verifyCredentials( $connection_credentials ) == false )
                throw new \ErrorException('Failed credential verfication');
        }

        $this->database_framework->addConnection( $connection_credentials );

        if ( $this->checkConnection() !== true )
            throw $this->checkConnection();

        if ( $set_variable )
        {

            $this->capsule = $this->database_framework->getConnection();
        }

        return true;
    }

    /**
     * @return bool|\Error|\Exception
     */

    private function checkConnection()
    {

        try
        {

            if ( $this->database_framework->getConnection()->getDatabaseName() )
                return true;
        }
        catch ( \Error $error )
        {

            return $error;
        }

        return false;
    }

    /**
     * @throws \ErrorException
     */

    private function getConnectionCredentials()
    {

        $connection_credentials = $this->getConnectionFile();

        if ( empty( $connection_credentials ) )
            throw new \ErrorException();


        if ( $this->verifyCredentials( $connection_credentials ) == false )
            throw new \ErrorException('Failed credential verfication');


        return $this->merge( $connection_credentials );
    }

    /**
     * @param $connection_credentials
     * @return bool
     */

    private function verifyCredentials( $connection_credentials )
    {

        $required = [
            'host',
            'database',
            'driver',
            'username',
            'password'
        ];

        foreach ( $required as $value )
        {

            if ( isset( $connection_credentials[ $value ] ) == false )
                return false;

        }

        return true;
    }

    /**
     * @param $connection_credentials
     * @return array
     */

    private function merge( $connection_credentials )
    {
        return array_merge( $connection_credentials, $this->mergers );
    }

    /**
     * @return array|mixed
     * @throws \ErrorException
     */

    private function getConnectionFile()
    {

        if ( defined('WEBSITE_CONNECTIONFILE') == false )
            throw new \ErrorException();

        return ( FileSystem::readAsJson( WEBSITE_CONNECTIONFILE, true ) );
    }
}