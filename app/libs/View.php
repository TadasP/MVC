<?php

namespace App\Libs;

class View
{
    private $viewCatalogPath = url.'app/views/';

    public function render($templatePath)
    {
        require ($this->viewCatalogPath.'header.php');
        require ($this->viewCatalogPath.$templatePath.'.php');
        require ($this->viewCatalogPath.'footer.php');
    }
}