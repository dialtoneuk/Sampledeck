<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 03/03/2018
 * Time: 02:17
 */

namespace Website\Application\Controllers;


use Website\Application\Controller;
use Website\Application\Interfaces\ControllerInterface;
use Website\Application\Interfaces\ModelInterface;
use ReCaptcha\ReCaptcha;
use Flight;
use Website\Users;

class RegisterController extends Controller implements ControllerInterface
{

    /**
     * @var $users Users
     */
    protected $users;
    protected $form_requirements = [
        'username',
        'email',
        'password',
        'g-recaptcha-response'
    ];

    protected $google;

    public function __construct(ModelInterface $model)
    {

        if ( RECAPTCHA_ENABLED )
            $this->google = new ReCaptcha( "6LfiXk0UAAAAACy27LhF4CzqhoHmU2WXw75XlcOT" );

        parent::__construct($model);
    }

    /**
     * @param object $request
     * @return mixed;
     */

    public function controller( object $request )
    {

        $this->sessions = Flight::sessions();
        $this->users = new Users();

        if ( $this->sessions->valid( session_id() ) )
        {

            Flight::redirect(WEBSITE_URL_ROOT );
            return true;
        }


        if ( $request->method == 'POST' )
        {

            if ( empty( $_POST ) )
                return false;

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
            $email = $_POST['email'];

            if ( RECAPTCHA_ENABLED )
            {

                $response = $this->google->verify( $_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR'] );

                if ( $response->isSuccess() == false )
                {

                    $this->addError('Failed google verification, try again');
                    return true;
                }
            }

            if ( filter_var( $email, FILTER_VALIDATE_EMAIL ) == false )
                return false;

            if ( $this->usernameTaken( $username ) )
            {

                $this->addError('Sorry, that username is taken. Please pick another one!');
                return true;
            }

            if ( $this->checkPassword( $password ) == false )
            {

                $this->addError('Sorry, that password is too weak. Pick a more complex one!');
                return true;
            }

            if ( $this->checkEmail( $email ) == false )
            {

                $this->addError('Sorry, that email is already tied to an account. Try resetting your password.');
                return true;
            }

            $salt = $this->getSalt();
            $password = $this->hashPassword( $password, $salt );

            $this->users->insert([
                'username'  => $username,
                'password'  => $password,
                'salt'      => $salt,
                'email'     => $email,
                'group'     => DEFAULT_GROUP,
                'colour'     => sprintf("%02x%02x%02x", rand(0,255), rand(0,255), rand(0,255))
            ]);

            Flight::redirect('login' );
        }
        else
        {

            return true;
        }
    }

    private function checkEmail( $email )
    {

        if ( $this->users->checkForEmail( $email ) == true )
        {

            return false;
        }

        return true;
    }

    private function getSalt()
    {

        return base64_encode( openssl_random_pseudo_bytes(16) );
    }

    private function hashPassword( $password, $salt )
    {

        return sha1( $password . $salt );
    }

    private function checkPassword( $password )
    {

        if ( strlen( $password ) <= 8 )
        {

            return false;
        }

        return true;
    }

    private function usernameTaken( $username )
    {

        return ( $this->users->checkForUsername( $username ) );
    }
}