<?php
namespace Kickstart\Controller;

class ContentController
{
    public function indexAction()
    {
        return require dirname(dirname(__DIR__)) . '/views/index.html';
    }
}
