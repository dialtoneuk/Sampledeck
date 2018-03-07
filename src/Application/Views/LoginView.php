<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 03/03/2018
 * Time: 02:47
 */

namespace Website\Application\Views;


use Website\Application\Interfaces\ModelInterface;
use Website\Application\Interfaces\ViewInterface;

class LoginView implements ViewInterface
{

    protected $model;

    public function __construct(ModelInterface $model)
    {

        $this->model = $model;
    }

    public function view()
    {

        return(
            [
                "templates/footer" => [
                    [],
                    'page_footer'
                ],
                "templates/header" => [
                    [ 'page_title' => 'Website' ],
                    'page_header'
                ],
                "templates/navbar" => [
                    [],
                    'page_navbar'
                ],
                'login'
            ]
        );
    }
}