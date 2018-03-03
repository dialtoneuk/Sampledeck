<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 03/03/2018
 * Time: 03:30
 */

namespace Website\Application\Controllers;


use Website\Application\ControllerInterface;
use Website\Application\ModelInterface;
use Website\Sessions;
use Website\Users;

/**
 * @property Users users
 * @property Sessions sessions
 */

class LoginController implements ControllerInterface
{

    protected $model;
    protected $form_errors = [];
    protected $form_requirements = [
        'username',
        'password',
        'verification'
    ];

    /**
     * LoginController constructor.
     * @param ModelInterface $model
     */

    public function __construct(ModelInterface $model)
    {

        if ( session_status() !== PHP_SESSION_ACTIVE )
        {

            session_start();
        }

        $this->model = $model;
    }

    /**
     * @param object $request
     * @return bool|mixed
     */

    public function controller(object $request)
    {

        if ( $request->method == 'POST' )
        {

            $this->users = new Users();
            $this->sessions = new Sessions();

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
            $validation = $_POST['validation'];

            if ( $this->users->checkForUsername( $username ) == false )
            {

                $this->addError('Your password or username is incorrect, please try again');
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

    /**
     * @param $message
     */

    private function addError( $message )
    {

        $this->model->set('errors', $this->model->get('errors')[] = $message );
    }

    /**
     *
     */

    private function cleanInput()
    {

        foreach ( $_POST as $key=>$value )
        {

            $_POST[ $key ] = strip_tags( $value );
        }
    }
}