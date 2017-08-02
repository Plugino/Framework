<?php

namespace Vitaminate\Tests\Vitaminate\Foundation;

use PHPUnit\Framework\TestCase;
use Vitaminate\Foundation\Application;

class ApplicationTest extends TestCase
{
    /**
     * @var Application
     */
    protected $app;

    public function setUp(){
        $this->app = new Application(realpath(__DIR__ . '/../..'));
    }

    public function testCanInstantiateWithoutParameter(){
        $app = new Application();
        $this->addToAssertionCount(1);
    }

    public function testBaseBindingsRegistering(){
        $this->assertTrue($this->app->make('app') instanceof Application);
    }

    public function testCanReturnVersion(){
        $this->assertEquals(Application::VERSION, $this->app->version());
    }
}