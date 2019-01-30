<?php

session_start();

require_once('vendor/autoload.php');

define('url','/wamp/www/2lvl/Tadas/Model-view-controler/');

if (isset($_SERVER['PATH_INFO'])){
    $path = strtolower(str_replace($_SERVER['SCRIPT_NAME'], '', $_SERVER['REQUEST_URI']));
    $path = explode('/', $path);

    $classFile = '';

    $controller = !empty($path[1]) ? $path[1] : NULL;
    $obj_method = !empty($path[2]) ? $path[2] : NULL;
    $var = !empty($path[3]) ? $path[3] : NULL;

    if(isset($controller)){
        $classFile = ucfirst($controller).'Controller';
    }

    if(file_exists('app/controllers/'.$classFile.'.php')){
        $class = 'App\Controllers\\'.$classFile;
        $object = new $class;
        if(!empty($obj_method)){
            $method = $obj_method;
            if(method_exists($object, $method) && !empty($var)){
                $object->$method($var);
            }else if(method_exists($object, $method) && empty($var)){
                $object->$method();
            }else{
                $classFile = 'ErrorController';
                $class = 'App\Controllers\\'.$classFile;
                $object = new $class;
                $object->showError('Method not found');
            }
        }else{
            $object->index();
        }
    }else{
        $classFile = 'ErrorController';
        $class = 'App\Controllers\\'.$classFile;
        $object = new $class;
        $object->showError('Page not found');
    }
}else{
    $classFile = 'IndexController';
    $class = 'App\Controllers\\'.$classFile;
    $object = new $class;
    $object->index();
}