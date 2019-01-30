<?php

namespace App\Libs;

use App\Libs\View as View;

class Controller
{
    protected $view;

    public function __construct()
    {
        $this->view = new View;
    }
}