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

class IndexView implements ViewInterface
{

    protected $model;

    public function __construct(ModelInterface $model)
    {

        $this->model = $model;
    }

    public function view()
    {

        return([
            'test.php'
        ]);
    }
}