<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 03/03/2018
 * Time: 00:44
 */

/**
 * ==============================================================================

##:::::::'########:'##:::::'##:'####::'######:::::'##::::::::::'###::::'##::: ##::'######:::::'###:::::'######::'########:'########:'########:: 2018
##::::::: ##.....:: ##:'##: ##:. ##::'##... ##:::: ##:::::::::'## ##::: ###:: ##:'##... ##:::'## ##:::'##... ##:... ##..:: ##.....:: ##.... ##: https://github.com/dialtoneuk
##::::::: ##::::::: ##: ##: ##:: ##:: ##:::..::::: ##::::::::'##:. ##:: ####: ##: ##:::..:::'##:. ##:: ##:::..::::: ##:::: ##::::::: ##:::: ##: lewislancastersoftware@gmail.com
##::::::: ######::: ##: ##: ##:: ##::. ######::::: ##:::::::'##:::. ##: ## ## ##: ##:::::::'##:::. ##:. ######::::: ##:::: ######::: ########:: https://thesummits.bandcamp.com
##::::::: ##...:::: ##: ##: ##:: ##:::..... ##:::: ##::::::: #########: ##. ####: ##::::::: #########::..... ##:::: ##:::: ##...:::: ##.. ##::: https://twitter.com/hackerman1998
##::::::: ##::::::: ##: ##: ##:: ##::'##::: ##:::: ##::::::: ##.... ##: ##:. ###: ##::: ##: ##.... ##:'##::: ##:::: ##:::: ##::::::: ##::. ##:: Om Theory #2318
########: ########:. ###. ###::'####:. ######::::: ########: ##:::: ##: ##::. ##:. ######:: ##:::: ##:. ######::::: ##:::: ########: ##:::. ##:
........::........:::...::...:::....:::......::::::........::..:::::..::..::::..:::......:::..:::::..:::......::::::..:::::........::..:::::..:

 * ==============================================================================
 */

require_once "vendor/autoload.php";

/**
 * If we are running through CLI we instead get the current working directory
 * and map from there
 * ==============================================================================
 */

define('WEBSITE_REALPATH', $_SERVER['DOCUMENT_ROOT'] . '/sampledeck/' );

/**
 * ==============================================================================
 */

/**
 *  Change these at your own demise
 * ==============================================================================
 */

define('WEBSITE_CONNECTIONFILE', '/config/connections/mysql.json' );
define('WEBSITE_ROUTESFILE', '/config/application/routes.json' );
define('FLIGHT_VIEWS_FOLDER', 'alpha');
define('WEBSITE_URL_ROOT', '/sampledeck/');
define('WEBSITE_NAME','Unibary');
define('SALT_LENGTH', 16);
define('PASSWORD_MIN_LENGTH', 6);
define('PASSWORD_STRICT', true);
define('DEFAULT_GROUP',1);
define('ADMIN_GROUP',2);
define('DEV_GROUP',3);
/**
 * ==============================================================================
 */

/**
 *  DO NOT EDIT THESE GLOBALS
 * ==============================================================================
 */

define('TYPE_CONTROLLER', 1);
define('TYPE_MODEL', 2);
define('TYPE_VIEW', 3);
define('CONTROLLERS_FOLDER', 'Controllers');
define('MODELS_FOLDER', 'Models');
define('VIEWS_FOLDER', 'Views');
define('PROFILES_FOLDER', 'Profiles');
define('WEBSITE_APPLICATION_NAMESPACE', 'Website\\Application\\');
define('WEBSITE_PROFILES', true );
define('GLOBAL_PROFILES', true );
define('DIRECTORY', '/');

/**
 * ==============================================================================
 */

/**
 * Google recaptcha
 * ==============================================================================
 */

define('SITE_KEY', '6LfiXk0UAAAAAEbbooiKPzwRH47kl1wmKMVVbjQ0');
define('SECRET_KEY', '6LfiXk0UAAAAACy27LhF4CzqhoHmU2WXw75XlcOT');
define('RECAPTCHA_ENABLED', true );

/**
 * ==============================================================================
 */

/**
 * Register the database connection class
 * ==============================================================================
 */

Flight::register('dbconnection', 'Website\Database\Connection');
Flight::register('sessions', 'Website\Sessions');

/**
 * ==============================================================================
 */

/**
 * Timing our startup
 */

Flight::set('timestart', microtime( true ) );

Flight::before('start', function ()
{

    Flight::set('timeend', microtime( true ) );
});

/**
 * ==============================================================================
 */

/**
 * Initiate the framework
 */

try
{

    $routes = new \Website\Application\Routes();

    foreach ( $routes->get() as $key=>$value )
    {

        $validation = [
            'model',
            'view',
            'controller'
        ];

        if ( count( $value ) !== count( $validation ) )
        {

            throw new ErrorException();
        }

        foreach ( $validation as $item )
        {

            if ( isset( $value[ $item ] ) == false )
            {

                throw new ErrorException();
            }
        }

        /**
         * Change the views folder
         */

        Flight::set('flight.views.path', './views/' . FLIGHT_VIEWS_FOLDER );

        Flight::route( $key,
            function() use ( $value )
            {

                $route = end( func_get_args() );

                if ( empty( $route ) )
                {

                    Flight::notFound();
                }
                else
                {

                    /**
                     * Start the session
                     */

                    session_start();


                    /**
                     * If website profiles are turned on, lets add the profiles to our view
                     */

                    if ( WEBSITE_PROFILES === true )
                    {

                        Flight::register('profilescontroller', 'Website\Application\ProfilesController');
                        $profiles = Flight::profilescontroller()->get();

                        if ( $profiles === false )
                        {

                            Flight::view()->set('profiles', new stdClass() );
                        }
                        else
                        {

                            $profiles = json_decode( json_encode( Flight::profilescontroller()->process( $profiles ) ) );

                            if ( GLOBAL_PROFILES === true )
                            {

                                Flight::view()->set('profiles', $profiles );
                                Flight::set('profiles', $profiles );
                            }

                            Flight::view()->set('profiles', $profiles );
                        }
                    }

                    /**
                     * Global the current route
                     */

                    Flight::set('route', $route );

                    /**
                     * @var \Website\Application\FrontController
                     */

                    Flight::register('frontcontroller', 'Website\Application\FrontController');
                    $payload = Flight::frontcontroller()->getPayload( $value['controller'], $value['model'], $value['view'] );

                    /**
                     * Global the payload
                     */

                    Flight::set('payload', $payload );
                    /**
                     * Now we initiate the controller, passing the request information as a parameter
                     */

                    /** @var \Website\Application\Interfaces\ControllerInterface $controller */
                    $controller = $payload->controller;
                    $result = $controller->controller( Flight::request() );

                    if ( $result === false )
                    {

                        Flight::notFound();
                    }

                    /**
                     * We will now return the models view method, and begin
                     */

                    /** @var \Website\Application\Interfaces\ViewInterface $view */
                    $view = $payload->view;
                    $output = $view->view();

                    if ( empty( $output ) )
                    {

                        Flight::notFound();
                    }
                    else
                    {

                        /** @var \Website\Application\Interfaces\ModelInterface $model */
                        $model = $payload->model;

                        /**
                         * Now lets set the model to be accessible as a variable from the template builder
                         */

                        Flight::view()->set('model', $model->model() );

                        /**
                         * Set some view  variables
                         */

                        Flight::view()->set('url_root', WEBSITE_URL_ROOT );
                        Flight::view()->set('website_name', WEBSITE_NAME );
                        Flight::view()->set('recaptcha_enabled', RECAPTCHA_ENABLED );
                        Flight::view()->set('recaptcha_sitekey', SITE_KEY );
                        Flight::view()->set('load_time', ( Flight::get('timeend') - Flight::get('timestart') ) / 60 * 60 * 24 );

                        /**
                         * Render output
                         */

                        foreach ( $output as $key=>$value )
                        {

                            if ( empty( $value ) == false )
                            {

                                if ( is_string( $value ) )
                                {

                                    Flight::render( $value );
                                    continue;
                                }

                                if ( is_array( $value ) )
                                {

                                    forward_static_call_array( array('Flight', 'render'), array( $key, $value[0], $value[1]));
                                    continue;
                                }
                            }
                            else
                            {

                                Flight::render( $key );
                            }
                        }
                    }
                }
            }, true);
    }
}
catch (ErrorException $error )
{

    Flight::error( $error );
}

/**
 * Start flight
 */

Flight::start();