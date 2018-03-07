<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 03/03/2018
 * Time: 03:30
 */

namespace Website\Application\Controllers;


use Website\Application\Controller;
use Website\Application\Interfaces\ControllerInterface;
use Flight;
use Website\Sessions;
use Website\Users;

/**
 * @property Users users
 * @property Sessions sessions
 */

class LoginController extends Controller implements ControllerInterface
{

    protected $form_errors = [];
    protected $form_requirements = [
        'username',
        'password',
        'verification'
    ];

    /**
     * @param object $request
     * @return bool|mixed
     */

    public function controller(object $request)
    {

        $this->sessions = new Sessions();

        if ( $this->sessions->valid( session_id() ) )
        {

            Flight::redirect(WEBSITE_URL_ROOT );
            return true;
        }

        if ( $request->method == 'POST' )
        {

            $this->users = new Users();

            if ( empty( $_POST ) )
            {

                return false;
            }

            $this->cleanInput();

            foreach ( $this->form_requirements as $value )
            {

                if ( isset( $_POST[ $value ] ) == false )
                {

                    $this->addError('Please enter all the information required');
                    return true;
                }
            }

            $username = $_POST['username'];
            $password = $_POST['password'];
            $verification = $_POST['verification'];

            if ( $this->users->checkForUsername( $username ) == false )
            {

                $this->addError('Your username is incorrect, please try again');
                return true;
            }

            $user = $this->users->getByUsername( $username );

            if ( $user->password !== sha1( $user->salt . $password ) )
            {

                $this->addError('Your password or username is incorrect, please try again');
                return true;
            }

            $this->sessions->insert(array(
                'sessionid'     => session_id(),
                'userid'        => $user->userid,
                'logintime'     => time(),
                'lastaction'    => time()
            ));

            return true;
        }
        else
        {

            return true;
        }
    }
}