<?php

namespace App\Controllers;

use App\Libs\Controller;

class ErrorController extends Controller
{
    public function showError($error)
    {   
        $this->view->error = $error;
        $this->view->render('error');
    }
}