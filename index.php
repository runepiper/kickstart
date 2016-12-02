<?php
    if (phpversion() < 7) {
        die('PHP 7 is required');
    }

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    define('BASEPATH', realpath(dirname(__FILE__)));
    require_once BASEPATH.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

    $app = new AppController();
