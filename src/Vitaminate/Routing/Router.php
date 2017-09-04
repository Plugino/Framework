<?php

namespace Vitaminate\Routing;

use Vitaminate\Foundation\Application;
use Vitaminate\Routing\Contracts\MatcherInterface;
use Vitaminate\Routing\RouteCollection;
use Vitaminate\Routing\Exceptions\RouteNotFoundException;

/**
 * Class Router
 *
 * @author Mystro Ken <mystroken@gmail.com>
 * @package Vitaminate\Routing
 */
class Router
{

    /**
     * @var Application
     */
    protected $app;

    /**
     * @var MatcherInterface $routeMatcher
     */
    protected $routeMatcher;

    /**
     * @var RouteCollection
     */
    protected $routeCollection;


    /**
     * Router constructor.
     * @param Application $app
     * @param RouteCollection $collection
     */
    public function __construct(RouteCollection $collection, Application $app)
    {
        $this->app = $app;
        $this->routeMatcher = new RouteMatcher();
        $this->routeCollection = $collection;
    }

    /**
     * @return mixed
     */
    public function run()
    {
        $route = $this->routeMatcher->getRoute($this->app->make('request'), $this->routeCollection);

        if(null === $route)
        {
            throw new RouteNotFoundException("Route not Found!");
        }

        $route->addActionArgument($this->app->make('request'));
        return $route->runAction();
    }

    /**
     * @param $name
     * @return URL
     */
    public function generateUrl($name)
    {
        $generatedUrl = null;

        $route = $this->routeCollection->get($name);

        if(null !== $route)
        {
            $generatedUrl = $route->getUrl();
        }

        return $generatedUrl;
    }
}