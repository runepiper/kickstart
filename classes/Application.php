<?php
namespace Kickstart;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Router;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Yaml\Yaml;

class Application
{
    /**
     * @var array
     */
    protected $settings = [];

    function __construct()
    {
        $this->loadSettings();
        $this->loadRouter();
    }

    private function loadSettings()
    {
        $this->settings = Yaml::parse(file_get_contents(dirname(__DIR__) . '/config/settings.yaml'));
    }

    private function loadRouter()
    {
        $locator = new FileLocator(dirname(__DIR__) . '/config');
        $routesCollection = new YamlFileLoader($locator);
        $requestContext = new RequestContext($_SERVER['REQUEST_URI']);

        $router = new Router(
            $routesCollection,
            'routes.yaml',
            [
                'cache_dir' => null
            ],
            $requestContext
        );

        $this->handleRequest($router);
    }

    /**
     * @param Router $router
     */
    public function handleRequest(Router $router)
    {
        try {
            $match = $router->match($_SERVER['PATH_INFO']);
            list($class, $method) = explode('::', $match['_controller'], 2);
            $arguments = [];

            foreach ($match as $argumentKey => $argumentValue) {
                if ($argumentKey !== '_controller' && $argumentKey !== '_route') {
                    $arguments[$argumentKey] = $argumentValue;
                }
            }

            // The arguments are in the same order as the router part, so in the method they can be called in the same order
            call_user_func_array([new $class, $method], $arguments);
        } catch(ResourceNotFoundException $e) {
            http_response_code(404);
            echo 'Not found.'; die();
        }
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function getSettings($key)
    {
        return $this->settings['Kickstart'][$key];
    }
}
