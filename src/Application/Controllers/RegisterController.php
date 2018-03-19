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

    /**
     * RegisterController constructor.
     * @param ModelInterface $model
     */

    public function __construct(ModelInterface $model)
    {

        $this->users = new Users();
        $this->setRequirements([
            'username',
            'password',
            'email'
        ]);

        parent::__construct($model);
    }

    /**
     * @param object $request
     * @return mixed;
     */

    public function controller( object $request )
    {

        $this->sessions = Flight::sessions();

        if ( $this->sessions->valid( session_id() ) )
        {

            Flight::redirect(WEBSITE_URL_ROOT );
        }
        else
        {

            if ( $request->method == 'POST' )
            {

                if ( empty( $_POST ) )
                    return false;

                $this->cleanInput();

                if ( $this->checkRequirements() == false )
                    return false;

                if ( $this->isRecaptchaEnabled() )
                {

                    if ( $this->hasRecaptchaResponse() == false )
                    {

                        $this->addError('No recaptcha response found, please try again.');
                        return true;
                    }
                    else
                    {

                        if ( $this->verifyRecaptcha( $_POST['g-recaptcha-response'] ) == false  )
                        {

                            $this->addError('Failed recaptcha, try again.');
                            return true;
                        }
                    }
                }

                $data = $this->getRequirements();

                if ( $this->usernameTaken( $data->username ) )
                {

                    $this->addError('Sorry, that username is taken. Please pick another one!');
                    return true;
                }

                if ( preg_match("/\d/",  $data->username ) === 0 || str_contains( $data->username, " " ) )
                {

                    $this->addError('Sorry, that username is invalid. Please pick another one!');
                    return true;
                }

                $this->addFormValue('username', $data->username );

                if ( filter_var( $data->email, FILTER_VALIDATE_EMAIL ) == false )
                {

                    $this->addError('Please enter a valid email address');
                    return true;
                }

                if ( $this->checkEmail( $data->email ) == false )
                {

                    $this->addError('Sorry, that email is already tied to an account. Try resetting your password.');
                    return true;
                }

                $this->addFormValue('email', $data->email );

                if ( $this->checkPassword( $data->password ) == false )
                {

                    $this->addError('Sorry, that password is too weak. It will need to be longer than '
                        . PASSWORD_MIN_LENGTH
                        . ' characters and contain a special character ('
                        . "!\"#$%&'()*+,-./:;<=>?@[\]^_`{|}~"
                        . ") It also can't contain any spaces."
                    );

                    if ( PASSWORD_STRICT )
                    {

                        $this->addError('Passwords will also need to contain a capital letter, and a number for added security');
                    }

                    return true;
                }

                $salt = $this->getSalt();
                $password = $this->hashPassword( $data->password, $salt );

                $this->users->insert([
                    'username'  => $data->username,
                    'password'  => $password,
                    'salt'      => $salt,
                    'email'     => $data->email,
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

        return true;
    }

    /**
     * @param $email
     * @return bool
     */

    private function checkEmail( $email )
    {

        if ( $this->users->checkForEmail( $email ) == true )
        {

            return false;
        }

        return true;
    }

    /**
     * @return string
     */

    private function getSalt()
    {

        return base64_encode( openssl_random_pseudo_bytes(SALT_LENGTH ) );
    }

    /**
     * @param $password
     * @param $salt
     * @return string
     */

    private function hashPassword( $password, $salt )
    {

        return sha1( $password . $salt );
    }

    /**
     * @param $password
     * @return bool
     */

    private function checkPassword( $password )
    {

        if ( strlen( $password ) <= PASSWORD_MIN_LENGTH )
        {

            return false;
        }

        if ( str_contains( $password, " " ) )
        {

            return false;
        }

        if ( PASSWORD_STRICT )
        {

            if ( preg_match( "/[A-Z]/", $password ) === 0 )
            {

                return false;
            }

            if ( preg_match("/\d/",  $password ) === 0 )
            {

                return false;
            }
        }

        return true;
    }

    /**
     * @param $username
     * @return bool
     */

    private function usernameTaken( $username )
    {

        return ( $this->users->checkForUsername( $username ) );
    }
}