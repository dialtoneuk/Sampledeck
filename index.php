<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 03/03/2018
 * Time: 00:44
 */

/**
 * ==============================================================================
 */

/**
##:::::::'########:'##:::::'##:'####::'######:::::'##::::::::::'###::::'##::: ##::'######:::::'###:::::'######::'########:'########:'########:: 2018
##::::::: ##.....:: ##:'##: ##:. ##::'##... ##:::: ##:::::::::'## ##::: ###:: ##:'##... ##:::'## ##:::'##... ##:... ##..:: ##.....:: ##.... ##: https://github.com/dialtoneuk
##::::::: ##::::::: ##: ##: ##:: ##:: ##:::..::::: ##::::::::'##:. ##:: ####: ##: ##:::..:::'##:. ##:: ##:::..::::: ##:::: ##::::::: ##:::: ##: lewislancastersoftware@gmail.com
##::::::: ######::: ##: ##: ##:: ##::. ######::::: ##:::::::'##:::. ##: ## ## ##: ##:::::::'##:::. ##:. ######::::: ##:::: ######::: ########:: https://thesummits.bandcamp.com
##::::::: ##...:::: ##: ##: ##:: ##:::..... ##:::: ##::::::: #########: ##. ####: ##::::::: #########::..... ##:::: ##:::: ##...:::: ##.. ##::: https://twitter.com/hackerman1998
##::::::: ##::::::: ##: ##: ##:: ##::'##::: ##:::: ##::::::: ##.... ##: ##:. ###: ##::: ##: ##.... ##:'##::: ##:::: ##:::: ##::::::: ##::. ##:: Om Theory #2318
########: ########:. ###. ###::'####:. ######::::: ########: ##:::: ##: ##::. ##:. ######:: ##:::: ##:. ######::::: ##:::: ########: ##:::. ##:
........::........:::...::...:::....:::......::::::........::..:::::..::..::::..:::......:::..:::::..:::......::::::..:::::........::..:::::..:
 */

/**
 * ==============================================================================
 */

require_once "vendor/autoload.php";

/**
 * If we are running through CLI we instead get the current working directory
 * and map from there
 * ==============================================================================
 */

if ( php_sapi_name() !== 'cli' )
{

    define('WEBSITE_REALPATH', $_SERVER['DOCUMENT_ROOT'] . '/website/' );
}
else
{

    define('WEBSITE_REALPATH', getcwd() );
}

/**
 * ==============================================================================
 */

/**
 * Change these if you change your connection file or routes file
 * ==============================================================================
 */

define('WEBSITE_CONNECTIONFILE', '/config/connections/mysql.json' );
define('WEBSITE_ROUTESFILE', '/config/application/routes.json' );

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

/**
 * ==============================================================================
 */

/**
 * Register the database connection class
 */

Flight::register('database_connection', 'Website\Database\Connection');

/**
 * Start to go through our routes
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
                     * We must globally set the route before we create the front controller so that it is globally accessible to the entire site.
                     */

                    Flight::set('route', $route );

                    /**
                     * Register the front controller into the shared container
                     */

                    /**
                     * @var \Website\Application\FrontController
                     */
                    Flight::register('frontcontroller', 'Website\Application\FrontController');

                    /**
                     * We will throw this in a try statement to catch any errors
                     */

                    $payload = Flight::frontcontroller()->getPayload( $value['controller'], $value['model'], $value['view'] );

                    /**
                     * We then globalize the front controllers payload so each of the classes are accessible through out the application
                     */

                    Flight::set('payload', $payload );

                    /**
                     * Now we initiate the controller, passing the request information as a parameter
                     */

                    /** @var \Website\Application\ControllerInterface $controller */
                    $controller = $payload->controller;
                    $result = $controller->controller( Flight::request() );

                    if ( $result === false )
                    {

                        Flight::notFound();
                    }

                    /**
                     * We will now return the models view method, and begin
                     */

                    /** @var \Website\Application\ViewInterface $view */
                    $view = $payload->view;
                    $output = $view->view();

                    if ( empty( $output ) )
                    {

                        Flight::notFound();
                    }
                    else
                    {

                        /** @var \Website\Application\ModelInterface $model */
                        $model = $payload->model;

                        Flight::set('model', $model->model() );

                        foreach ( $output as $key=>$value )
                        {

                            if ( empty( $value ) == false )
                            {

                                forward_static_call( array('Flight', 'render'), $value );
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