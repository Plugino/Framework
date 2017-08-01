<?php

namespace Vitaminate\View;

use Vitaminate\Contracts\View\View as ViewContract;
use Vitaminate\Contracts\Support\Renderable;

class View implements ViewContract
{
    /**
     * @var string
     */
    protected $templateFile;
    /**
     * @var string
     */
    protected $templatePath;
    /**
     * @var array
     */
    protected $allowedExtensions = ['php','html','htm'];
    /**
     * @var array
     */
    protected $attributes;

    /**
     *
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
     * Get the template file URI
     *
     * directory.file => directory/file = $templatePath 
     * $templateFile = $templatePath . $allowedExtensions[$index]
     * throws RuntimeException if there is no matched combinaison of $templateFile
     *
     * @param $template string
     * @return string
     *
     * @throws \RuntimeException
     */
    protected function getTemplateFile($template){

        if(empty($template)){
            throw new \RuntimeException("There is no file to load");
        }

        $templatePath = '';
        $templateFileExtension = null;
        $pathParameters = explode('.', $template);
        $pathParametersLength = count($pathParameters);

        for($i = 0; $i < $pathParametersLength-1; $i++) $templatePath .= $pathParameters[$i] . '/';
        $templatePath .= $pathParameters[$pathParametersLength-1];

        // Look for the correct first extension 
        for($j = 0; $j < count($this->allowedExtensions); $j++){
            if (is_file($this->templatePath . $templatePath . '.' . $this->allowedExtensions[$j])) {
                $templateFileExtension = $this->allowedExtensions[$j];
                break;
            }
        }

        if(null === $templateFileExtension){
            throw new \RuntimeException("View cannot render `{$this->templatePath}{$templatePath}.[php|html|htm]` because the template does not exist");
        }

        return $this->templatePath . $templatePath . '.' . $templateFileExtension;
    }

    /**
     * Load a template and returns the result as a string or echo it
     *
     * @param $template string the filename without the extension
     * @param array $data
     * @param boolean $echo
     *
     * @return mixed
     *
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     * @throws \Exception
     */
    public function load($template, array $data = [], $echo = true)
    {
        // Get the file
        $this->templateFile = $this->getTemplateFile($template);

        // Get template

        $data = array_merge($this->attributes, $data);
        try {
            ob_start();
            $this->protectedIncludeScope($this->templateFile, $data);
            $output = ob_get_clean();
        } catch(\Exception $e) {
            ob_end_clean();
            throw $e;
        }

        if( true === $echo)
        {
            echo $output;
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
}