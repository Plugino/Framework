<?php

namespace Vitaminate\Routing;

class URL
{
    /**
     * @var string $path
     */
    protected $path;
    /**
     * @var array $parameters
     */
    protected $parameters;

    /**
     * @var URL $instance
     */
    public static $instance;


    /**
     * URL constructor.
     *
     * @param string $path
     * @param array $parameters
     */
    public function __construct($path = '', array $parameters = [])
    {
        $this->path = $path;
        $this->parameters = $parameters;
    }

    /**
     * @return URL
     */
    public static function getInstance()
    {/*
        if(is_null(static::$instance)){
            static::$instance = new URL();
        }
    */
        return new URL();
        //return static::$instance;
    }

    /**
     * @param $name
     * @return URL
     */
    public static function to($name)
    {
        /**
         * @var Router $router
         */
        $router = app('router');
        return $router->generateUrl($name);
    }

    /**
     * @param $key
     * @param null $value
     * @return $this
     */
    public function with($key, $value = null)
    {
        if( is_array($key) )
        {
            foreach ($key as $item => $data)
            {
                $this->addParameter($item, $data);
            }
        }
        elseif ( is_string($key) )
        {
            $this->addParameter($key, $value);
        }

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $queryString = '?';
        if(empty($this->parameters)) return site_url($this->path);

        foreach ($this->parameters as $key => $value)
        {
            $queryString .= $key.'='.$value.'&';
        }

        return site_url($this->path) . trim($queryString, '&');
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     * @return $this
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param array $parameters
     * @return $this
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
        return $this;
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function addParameter($key, $value)
    {
        if( !is_null($value) )
        {
            $this->parameters[$key] = $value;
        }
        return $this;
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function getParameter($key)
    {
        if( $this->hasParameter($key) ){
            return $this->parameters[$key];
        }
        return null;
    }

    public function removeParameter($key)
    {
        if( $this->hasParameter($key) ){
            unset($this->parameters[$key]);
        }
        return $this;
    }

    /**
     * @param $key
     * @return bool
     */
    public function hasParameter($key)
    {
        return isset($this->parameters[$key]) && !is_null($this->parameters[$key]);
    }

}