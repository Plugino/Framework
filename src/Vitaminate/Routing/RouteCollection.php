<?php

namespace Vitaminate\Routing;

use Vitaminate\Routing\Contracts\RouteCollectionInterface;

/**
 * Class RouteCollection
 *
 * @author Mystro Ken <mystroken@gmail.com>
 * @package Vitaminate\Routing
 */
class RouteCollection implements RouteCollectionInterface
{
    /**
     * @var Route[]
     */
    protected $routes;

    /**
     * @param $name
     * @param Route $route
     * @return $this
     */
    public function add($name, Route $route)
    {
        unset($this->routes[$name]);
        $this->routes[$name] = $route;
        return $this;
    }

    /**
     * @param $name
     * @return $this
     */
    public function remove($name)
    {
        unset($this->routes[$name]);
        return $this;
    }

    /**
     * @param $name
     * @return null|Route
     */
    public function get($name)
    {
        return (isset($this->routes[$name]) && $this->routes[$name] instanceof Route) ? $this->routes[$name] : null;
    }

    /**
     * @return Route[]
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * @param Route[] $routes
     */
    public function setRoutes($routes)
    {
        $this->routes = $routes;
    }
}