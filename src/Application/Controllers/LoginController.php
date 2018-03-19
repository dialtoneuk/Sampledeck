<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 03/03/2018
 * Time: 03:30
 */

namespace Website\Application\Controllers;


use ReCaptcha\ReCaptcha;
use Website\Application\Controller;
use Website\Application\Interfaces\ControllerInterface;
use Flight;
use Website\Application\Interfaces\ModelInterface;
use Website\Sessions;
use Website\Users;

/**
 * @property Users users
 * @property Sessions sessions
 */

class LoginController extends Controller implements ControllerInterface
{

    /**
     * LoginController constructor.
     * @param ModelInterface $model
     */

    public function __construct(ModelInterface $model)
    {

        $this->users = new Users();
        $this->setRequirements([
            'username',
            'password'
        ]);

        parent::__construct($model);
    }

    /**
     * @param object $request
     * @return bool|mixed
     */

    public function controller(object $request)
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

                if ( $this->users->checkForUsername( $data->username ) == false )
                {

                    $this->addError('Your username is incorrect, please try again');
                    return true;
                }

                $user = $this->users->getByUsername( $data->username );

                if ( $user->password !== sha1( $data->password . $user->salt ) )
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

                Flight::redirect('/');
                return true;
            }
            else
            {

                return true;
            }
        }

        return true;
    }
}