<?php

namespace Kickstart\Base;

use Symfony\Component\Yaml\Yaml;

class AppController
{
    /**
     * @var array
     */
    protected $settings = [];

    function __construct()
    {
        $this->settings = Yaml::parse(file_get_contents(__DIR__.'/../../../config/settings.yaml'));
        $this->loadRouter();
    }

    private function loadRouter()
    {
        $router = new Router();
        require_once __DIR__.'/../../../config/routes.php';
        $router->execute();
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function getSettings($key)
    {
        return $this->settings['Kickstart']['Base'][$key];
    }
}
