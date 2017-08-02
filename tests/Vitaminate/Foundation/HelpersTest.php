<?php

namespace Vitaminate\Tests\Vitaminate\Foundation;

use Illuminate\Container\Container;
use PHPUnit\Framework\TestCase;
use Vitaminate\Foundation\Application;

class HelpersTest extends TestCase
{
    public function testCanRetrieveAppInstance(){
        $this->assertInstanceOf(
            Application::class,
            app()
        );
    }

    public function testCanRetrieveAppInstanceFromAbstract(){
        $this->assertInstanceOf(
            Application::class,
            app(Container::class)
        );
    }
}