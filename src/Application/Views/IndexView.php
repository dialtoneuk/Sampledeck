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
use Flight;
use Website\Sessions;

class IndexView implements ViewInterface
{

    protected $model;

    /**
     * @var Sessions
     */

    public $sessions;

    public function __construct(ModelInterface $model)
    {

        $this->sessions = Flight::sessions();
        $this->model = $model;
    }

    public function view()
    {

        if ( $this->sessions->valid( session_id() ) )
            $content = "index_user";
        else
            $content = "index_guest";

        return(
            [
                "templates/footer" => [
                    [],
                    'page_footer'
                ],
                "templates/header" => [
                    [
                        'page_title' => WEBSITE_NAME
                    ],
                    'page_header'
                ],
                "templates/navbar" => [
                    [],
                    'page_navbar'
                ],
                "templates/breadcrumb" => [
                    [],
                    'page_breadcrumb'
                ],
                "templates/content/" . $content =>[
                    [],
                    'index_content'
                ],
                'index'
            ]
        );
    }
}