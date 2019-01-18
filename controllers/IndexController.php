<?php

include_once url.'libs/Controller.php';

class IndexController extends Controller
{
    public function index()
    {
        $this->view->title = 'Index';
        $this->view->headline = 'Index';
        $this->view->render('index');
    }
}