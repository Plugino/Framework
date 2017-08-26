<?php
namespace Vitaminate\Routing;


class URL
{
    /**
     * @var URL $instance
     */
    public static $instance;


    public function __construct()
    {
    }

    public static function getInstance()
    {
        if(is_null(static::$instance)){
            static::$instance = new URL();
        }
        return static::$instance;
    }

    public static function to($name)
    {
        /**
         * @var Router $router
         */
        $router = app('router');
        return $router->generateUrl($name);
    }
}