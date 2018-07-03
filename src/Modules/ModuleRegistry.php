<?php

namespace SON\Framework\Modules;

use SON\Framework\App;

class ModuleRegistry
{
    private $app;
    private $composer;
    private $modules = [];

    public function setApp(App $app)
    {
        $this->app = $app;
    }

    public function setComposer($composer)
    {
        $this->composer = $composer;
    }

    public function add(Contract $module)
    {
        $this->modules[] = $module;
    }

    public function run()
    {
        foreach ($this->modules as $module) {
            $this->registry($module);
        }
    }

    private function registry($module)
    {
        $app = $this->app;
        $router = $app->getRouter();
        $container = $app->getContainer();

        $namespaces = $module->getNamespaces();

        foreach ($namespaces as $prefix => $path) {
            $this->composer->setPsr4($prefix, $path);
        }

        require $module->getContainerConfig();
        require $module->getEventConfig();
        require $module->getMiddlewareConfig();
        require $module->getRouteConfig();
    }
}
