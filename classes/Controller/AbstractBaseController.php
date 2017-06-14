<?php
namespace Kickstart\Controller;

use TYPO3Fluid\Fluid\View\TemplateView;
use Symfony\Component\Yaml\Yaml;

abstract class AbstractBaseController
{
    /**
     * @var TemplateView
     */
    protected $view;

    /**
     * @var array
     */
    protected $settings = [];

    function __construct() {
        $this->loadSettings();
        $this->initializeTemplateEngine();
    }

    private function loadSettings()
    {
        $this->settings = Yaml::parse(file_get_contents(dirname(dirname(__DIR__)) . '/config/settings.yaml'))['Kickstart'];
    }

    protected function initializeTemplateEngine()
    {
        $this->view = new TemplateView();

        $paths = $this->view->getTemplatePaths();
        $paths->setTemplateRootPaths([
            $this->settings['templateRootPath']
        ]);
        $paths->setLayoutRootPaths([
            $this->settings['layoutRootPath']
        ]);
        $paths->setPartialRootPaths([
            $this->settings['partialRootPath']
        ]);

        $controllerName = (new \ReflectionClass(get_called_class()))->getShortName();
        $controllerName = str_replace('Controller', '', $controllerName);

        $renderingContext = $this->view->getRenderingContext();
        $renderingContext->setControllerName($controllerName);
    }

    function __destruct()
    {
        echo $this->view->render();
    }
}
