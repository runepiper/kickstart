<?php

    $router->addRoute('/', function () {
        echo file_get_contents('views/home.html');
    });

    $router->addRoute('404', function () {
        http_response_code(404);
        die('Page not found');
    });
