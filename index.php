<?php

session_start();
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

    if(file_exists('controllers/'.$classFile.'.php')){
        include_once 'controllers/'.$classFile.'.php';
        $object = new $classFile;
        if(!empty($obj_method)){
            $method = $obj_method;
            if(method_exists($object, $method) && !empty($var)){
                $object->$method($var);
            }else if(method_exists($object, $method) && empty($var)){
                $object->$method();
            }else{
                $classFile = 'ErrorController';
                include_once 'controllers/'.$classFile.'.php';
                $object = new $classFile;
                $object->showError('Method not found');
            }
        }else{
            $object->index();
        }
    }else{
        $classFile = 'ErrorController';
        include_once 'controllers/'.$classFile.'.php';
        $object = new $classFile;
        $object->showError('Page Not Found');
    }
}else{
    $classFile = 'IndexController';
    include_once 'controllers/'.$classFile.'.php';
    $object = new $classFile;
    $object->index();
}
