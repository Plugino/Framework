<?php
namespace Vitaminate\Routing\Contracts;

use Vitaminate\Http\Request;

/**
 * interface MatcherInterface
 *
 * @author Mystro Ken <mystroken@gmail.com>
 * @package Vitaminate\Routing\Contracts
 */
interface MatcherInterface
{

    /**
     * Get the matched route from the request.
     *
     * @param Request $request
     * @param RouteCollectionInterface $routeCollection
     * @return null|\Vitaminate\Routing\Route
     */
    public function getRoute(Request $request, RouteCollectionInterface $routeCollection);
}