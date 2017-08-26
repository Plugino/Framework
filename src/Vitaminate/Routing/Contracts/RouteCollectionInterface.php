<?php

namespace Vitaminate\Routing\Contracts;

/**
 * interface RouteCollectionInterface
 *
 * @author Mystro Ken <mystroken@gmail.com>
 * @package Vitaminate\Routing\Contracts
 */
interface RouteCollectionInterface
{
    /**
     * Gets an array of all routes.
     *
     * @return array
     */
    public function getRoutes();
}