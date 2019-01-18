<?php

include_once url.'libs/Controller.php';

class UsersController extends Controller
{
    public function index()
    {
        $this->view->title = 'Users';
        $this->view->headline = 'Users headline';
        $this->view->render('users');
    }

    public function show($id)
    {
        echo $id;
    }
}