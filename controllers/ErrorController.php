<?php

include_once url.'libs/Controller.php';

class ErrorController extends Controller
{
    public function showError($error)
    {   
        $this->view->error = $error;
        $this->view->render('error');
    }
}