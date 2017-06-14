<?php
namespace Kickstart\Controller;

class ContentController extends AbstractBaseController
{
    public function indexAction()
    {
        $this->view->getRenderingContext()->setControllerAction('index');

        $this->view->assign('helloWorld', 'Hello World');
    }
}
