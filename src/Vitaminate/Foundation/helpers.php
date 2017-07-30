<?php

use Illuminate\Container\Container;

if (! function_exists('app')) {
    /**
     * Get the available container instance.
     *
     * @param  string  $abstract
     * @param  array   $parameters
     * @return mixed|\Vitaminate\Foundation\Application
     */
    function app($abstract = null, array $parameters = [])
    {
        if (is_null($abstract)) {
            return Container::getInstance();
        }
        //return empty($parameters)
        //    ? Container::getInstance()->make($abstract)
        //    : Container::getInstance()->makeWith($abstract, $parameters);

        return Container::getInstance()->make($abstract);
    }
}