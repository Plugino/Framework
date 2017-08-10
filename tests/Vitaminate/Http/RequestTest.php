<?php

namespace Vitaminate\Tests\Vitaminate\Http;

use PHPUnit\Framework\TestCase;
use Vitaminate\Http\Request;

class RequestTest extends TestCase
{
    /**
     * @var Request $request
     */
    protected $request;

    public function setUp()
    {
        $this->request = Request::createFromGlobals();
    }
}