<?php

class AppController
{
    function __construct()
    {
        $router = new Router();
        require_once BASEPATH.DIRECTORY_SEPARATOR.'config/routes.php';
        $router->execute();
    }
}
