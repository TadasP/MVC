<?php

namespace App\Controllers;

use App\Libs\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $this->view->title = 'Index';
        $this->view->headline = 'Index';
        $this->view->render('index');
    }
}