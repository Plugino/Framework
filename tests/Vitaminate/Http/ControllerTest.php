<?php

namespace Vitaminate\Tests\Vitaminate\Http;

use PHPUnit\Framework\TestCase;
use Vitaminate\Http\Controller;
use Vitaminate\Tests\Vitaminate\Http\Controllers\FakeController;

class ControllerTest extends TestCase
{
    /**
     * @var Controller
     */
    protected $controller;

    public function setUp(){
        $this->controller = new FakeController();
    }

    public function testCanCallAction(){
        $this->assertEquals('detail action', $this->controller->callAction('detail'));
    }

    public function testCannotCallUndefinedAction(){
        $this->expectException(\BadMethodCallException::class);
        $this->controller->callAction('undefinedAction');
    }
}