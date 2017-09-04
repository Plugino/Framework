<?php

namespace Vitaminate\Tests\Vitaminate\Http;


use Vitaminate\Http\Request;

class FakeRequest extends Request
{
    public function __construct(array $query = array(), array $request = array(), array $attributes = array(), array $cookies = array(), array $files = array(), array $server = array(), $content = null)
    {
        parent::__construct(['page' => 'test'], $request, $attributes, $cookies, $files, $server, $content);
    }

    public function getRequestUri()
    {
        return 'http://wordpress.dev/wp-admin.php?';
    }
}