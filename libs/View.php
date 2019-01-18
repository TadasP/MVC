<?php

class View
{
    private $viewCatalogPath = url.'views/';

    public function render($templatePath)
    {
        require ($this->viewCatalogPath.'header.php');
        require ($this->viewCatalogPath.$templatePath.'.php');
        require ($this->viewCatalogPath.'footer.php');
    }
}