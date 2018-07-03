<?php

namespace SON\Framework\Modules;

interface Contract
{
    public function getNamespaces() :array;
    public function getContainerConfig() :string;
    public function getEventConfig() :string;
    public function getMiddlewareConfig() :string;
    public function getRouteConfig() :string;
}
