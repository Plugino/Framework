<?php

namespace Vitaminate\Routing;

use Vitaminate\Http\Request;
use Vitaminate\Routing\Route;
use Vitaminate\Routing\Contracts\RouteCollectionInterface;

/**
 * Class Matcher
 *
 * @author Mystro Ken <mystroken@gmail.com>
 * @package Vitaminate\Routing
 */
class RouteMatcher
{

    /**
     * Get the matched route from the request.
     *
     * @param Request $request
     * @param RouteCollectionInterface $routeCollection
     * @return null|\Vitaminate\Routing\Route
     */
    public function getRoute(Request $request, RouteCollectionInterface $routeCollection)
    {
        $routeMatch = null;

        $url = parse_url($request->getRequestUri());
        $parameters = $request->query->all();
        $path = $url["path"];

        /**
         * @var Route $route
         */
        foreach ($routeCollection->getRoutes() as $route)
        {
            $routePath = $route->getUrl()->getPath();
            $routeParameters = $route->getUrl()->getParameters();
            $parametersMatch = array_intersect($routeParameters, $parameters);

            if( $path != $routePath ) continue;
            if( sizeof($parametersMatch) !== sizeof($routeParameters) ) continue;
            if( serialize($parametersMatch) !== serialize($routeParameters) ) continue;

            $routeMatch = $route;
            break;
        }

        return $routeMatch;
    }
}