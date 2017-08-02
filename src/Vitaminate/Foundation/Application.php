<?php

namespace Vitaminate\Foundation;

use \Vitaminate\Contracts\Foundation\Application as ApplicationContract;
use Illuminate\Container\Container;

class Application extends Container implements ApplicationContract
{
    /**
     * The Vitamin framework version.
     *
     * @var string
     */
    const VERSION = '0.1.0';
    /**
     * The base path for the Laravel installation.
     *
     * @var string
     */
    protected $basePath;


    /**
     * Creates a new vitamin application instance.
     *
     * @param string|null $basePath
     */
    public function __construct($basePath = null)
    {
        if($basePath) {
            $this->setBasePath($basePath);
        }

        $this->registerBaseBindings();
    }

    /**
     * Register the basic bindings into the container.
     *
     * @return void
     */
    protected function registerBaseBindings()
    {
        static::setInstance($this);
        $this->instance('app', $this);
        $this->instance(Container::class, $this);
    }

    /**
     * Bind all of the application paths in the container.
     *
     * @return void
     */
    protected function bindPathsInContainer()
    {
        $this->instance('path', $this->path());
        $this->instance('path.base', $this->basePath());
        $this->instance('path.config', $this->configPath());
    }

    /**
     * Sets the base path for the application.
     *
     * @param  string  $basePath
     * @return $this
     */
    public function setBasePath($basePath)
    {
        $this->basePath = rtrim($basePath, '\/');
        $this->bindPathsInContainer();
        return $this;
    }

    /**
     * Get the path to the application "app" directory.
     *
     * @param string $path Optionally, a path to append to the app path
     * @return string
     */
    public function path($path = '')
    {
        return $this->basePath.DIRECTORY_SEPARATOR.'app'.($path ? DIRECTORY_SEPARATOR.$path : $path);
    }

    /**
     * Get the base path of the vitamin installation.
     *
     * @param string $path
     * @return string
     */
    public function basePath($path = '')
    {
        return $this->basePath.($path ? DIRECTORY_SEPARATOR.$path : $path);
    }

    /**
     * Get the path to the application configuration files.
     *
     * @param string $path Optionally, a path to append to the config path
     * @return string
     */
    public function configPath($path = '')
    {
        return $this->basePath.DIRECTORY_SEPARATOR.'config'.($path ? DIRECTORY_SEPARATOR.$path : $path);
    }

    /**
     * Get the version number of the application.
     *
     * @return string
     */
    public function version()
    {
        return static::VERSION;
    }
}