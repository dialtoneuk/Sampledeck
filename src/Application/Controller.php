<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 04/03/2018
 * Time: 03:29
 */

namespace Website\Application;


use Website\Application\Interfaces\ModelInterface;
use Website\Sessions;
use ReCaptcha\ReCaptcha;

class Controller
{

    /**
     * @var ModelInterface
     */

    public $model;

    /**
     * @var Sessions
     */

    public $sessions;

    /**
     * @var ReCaptcha
     */

    public $google = null;

    /**
     * @var array
     */

    public $form_requirements = [];

    /**
     * Controller constructor.
     * @param ModelInterface $model
     */

    public function __construct( ModelInterface $model )
    {

        $this->model = $model;

        if ( RECAPTCHA_ENABLED )
            $this->google = new ReCaptcha( SECRET_KEY );
    }

    /**
     * @param $message
     */

    public function addError( $message )
    {

        if ( $this->model->has('errors') == false )
        {

            $this->model->set('errors', [$message]);
            return;
        }

        $errors = $this->model->get('errors');
        $errors[] = $message;

        $this->model->set('errors', $errors );
    }

    /**
     * @param $key
     * @param $value
     */

    public function addFormValue( $key, $value )
    {

        if ( $this->model->has('form') == false )
        {

            $this->model->set('form', [ $key => $value ] );
            return;
        }

        $form = $this->model->get('form');
        $form[ $key ] = $value;

        $this->model->set('form', $form );
    }

    /**
     * @return bool
     */

    public function isRecaptchaEnabled()
    {

        return( RECAPTCHA_ENABLED );
    }

    /**
     * @return bool
     */

    public function hasRecaptchaResponse()
    {

        if ( isset( $_POST['g-recaptcha-response'] ) == false )
            return false;

        return true;
    }

    /**
     * @param $response
     * @return bool
     */

    public function verifyRecaptcha( $response )
    {

        $response = $this->google->verify( $response, $_SERVER['REMOTE_ADDR'] );

        if ( $response->isSuccess() == false )
            return false;

        return true;
    }

    /**
     * @return mixed
     */

    public function getRequestMethod()
    {

        return( $_SERVER['REQUEST_METHOD'] );
    }

    /**
     * @return bool
     */

    public function checkRequirements()
    {

        foreach ( $this->form_requirements as $value )
        {

            if ( isset( $_POST[ $value ] ) == false )
                return false;
        }

        return true;
    }

    /**
     * @param $array
     */

    public function setRequirements( $array )
    {

        $this->form_requirements = $array;
    }

    /**
     * @return \stdClass
     */

    public function getRequirements()
    {

        $class = new \stdClass();

        foreach ( $this->form_requirements as $form_requirement )
        {

            $class->$form_requirement = $_POST[ $form_requirement ];
        }

        return $class;
    }

    /**
     *
     */

    public function cleanInput()
    {

        foreach ( $_POST as $key=>$value )
            $_POST[ $key ] = strip_tags( $value );
    }
}