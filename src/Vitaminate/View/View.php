<?php

namespace Vitaminate\View;

use Vitaminate\Contracts\View\View as ViewContract;
use Vitaminate\Contracts\Support\Renderable;

class View implements ViewContract
{
    /**
     * @var string
     */
    protected $templatePath;
    /**
     * @var array
     */
    protected $attributes;

    /**
     * View constructor.
     *
     * @param string $templatePath
     * @param array $attributes
     */
    public function __construct($templatePath = "", $attributes = [])
    {
        $this->templatePath = rtrim($templatePath, '/\\') . '/';
        $this->attributes = $attributes;
    }

    /**
     * Render a template
     *
     * $data cannot contain template as a key
     *
     * throws RuntimeException if $templatePath . $template does not exist
     *
     * @param string             $template
     * @param array              $data
     *
     * @return mixed
     *
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public function render($template, array $data = [])
    {
        return $this->fetch($template, $data);
    }

    /**
     * Get the attributes for the renderer
     *
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }
    /**
     * Set the attributes for the renderer
     *
     * @param array $attributes
     */
    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;
    }
    /**
     * Add an attribute
     *
     * @param $key
     * @param $value
     */
    public function addAttribute($key, $value) {
        $this->attributes[$key] = $value;
    }
    /**
     * Retrieve an attribute
     *
     * @param $key
     * @return mixed
     */
    public function getAttribute($key) {
        if (!isset($this->attributes[$key])) {
            return false;
        }
        return $this->attributes[$key];
    }

    /**
     * Renders a template and returns the result as a string
     *
     * cannot contain template as a key
     *
     * throws RuntimeException if $templatePath . $template does not exist
     *
     * @param $template
     * @param array $data
     *
     * @return mixed
     *
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     * @throws \Exception
     */
    public function fetch($template, array $data = []) {
        if (isset($data['template'])) {
            throw new \InvalidArgumentException("Duplicate template key found");
        }
        if (!is_file($this->templatePath . $template)) {
            throw new \RuntimeException("View cannot render `$template` because the template does not exist");
        }

        $data = array_merge($this->attributes, $data);
        try {
            ob_start();
            $this->protectedIncludeScope($this->templatePath . $template, $data);
            $output = ob_get_clean();
        } catch(\Exception $e) {
            ob_end_clean();
            throw $e;
        }
        return $output;
    }
    /**
     * @param string $template
     * @param array $data
     */
    protected function protectedIncludeScope ($template, array $data) {
        extract($data);
        include func_get_arg(0);
    }

    /**
     * Add a piece of data to the view.
     *
     * @param  string|array $key
     * @param  mixed $value
     * @return ViewContract
     */
    public function with($key, $value = null)
    {
        return $this;
    }
}