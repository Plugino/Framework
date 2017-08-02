<?php

namespace Vitaminate\Http;

abstract class Controller
{

    /**
     * Executes an action on the controller.
     *
     * @param  string  $method
     * @param  array   $parameters
     * @return mixed
     */
    public function callAction($method, $parameters = [])
    {
        return call_user_func_array([$this, $method], $parameters);
    }

    /**
     * Handles calls to missing methods on the controller.
     *
     * @param  string  $method
     * @param  array   $parameters
     * @return mixed
     *
     * @throws \BadMethodCallException
     */
    public function __call($method, $parameters)
    {
        throw new \BadMethodCallException("Method [{$method}] does not exist.");
    }

}