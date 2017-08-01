<?php

namespace Vitaminate\Contracts\View;


interface View
{
    /**
     * Load a template and returns the result as a string or echo it
     *
     * throws RuntimeException if $templatePath . $template does not exist
     *
     * @param $template
     * @param array $data
     * @param boolean $echo
     *
     * @return mixed
     *
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     * @throws \Exception
     */
    public function load($template, array $data = [], $echo = true);
}