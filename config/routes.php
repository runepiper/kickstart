<?php

    $router->addRoute('/', function () {
        echo file_get_contents(BASEPATH.DIRECTORY_SEPARATOR.'views/home.html');
    });

    $router->addRoute('404', function () {
        die('Page not found');
    });
