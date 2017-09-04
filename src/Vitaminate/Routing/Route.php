<?php

namespace Vitaminate\Routing;
use Vitaminate\Routing\Exceptions\InvalidCallableException;

/**
 * Class Route
 *
 * @author Mystro Ken <mystroken@gmail.com>
 * @package Vitaminate\Routing
 */
class Route
{
    /**
     * @var URL $url
     */
    protected $url;

    /**
     * @var string $controller
     */
    protected $controller;

    /**
     * Instantiate a new route.
     *
     * @param string $path
     * @param string $controller
     * @param array $parameters
     */
    public function __construct($path, $controller, array $parameters)
    {
        $this->controller = $controller;
        $this->url = new URL($path, $parameters);
    }


    /**
     * @var array
     */
    protected $actionArguments = [];

    /**
     * @return string
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @param string $controller
     * @return self
     */
    public function setController($controller)
    {
        $this->controller = $controller;
        return $this;
    }

    /**
     * @return array
     */
    public function getActionArguments()
    {
        return $this->actionArguments;
    }

    /**
     * @param $argument
     * @return $this
     */
    public function addActionArgument($argument)
    {
        $this->actionArguments[] = $argument;
        return $this;
    }

    /**
     * @param array $actionArguments
     * @return $this
     */
    public function setActionArguments($actionArguments)
    {
        $this->actionArguments = $actionArguments;
        return $this;
    }

    public function runAction()
    {
        if( is_callable($this->controller) )
        {
            return call_user_func_array($this->controller, $this->actionArguments);
        }
        else if( is_string($this->controller) )
        {
            $decomposition = explode('@', $this->controller);

            if(sizeof($decomposition) === 2)
            {
                $controller = $decomposition[0];
                $action = $decomposition[1];

                $controllerInstance = new $controller();
                return call_user_func([$controllerInstance, 'callAction'], $action, $this->actionArguments);
            }
        }

        throw new InvalidCallableException("The action of the route can't be called!");
    }

    /**
     * @return URL
     */
    public function getUrl()
    {
        return $this->url;
    }
}