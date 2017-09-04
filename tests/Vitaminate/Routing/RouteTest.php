<?php

namespace Vitaminate\Tests\Vitaminate\Routing;

use PHPUnit\Framework\TestCase;
use Vitaminate\Routing\Exceptions\InvalidCallableException;
use Vitaminate\Routing\Route;
use Vitaminate\Routing\URL;

class RouteTest extends TestCase
{
    /**
     * @var Route $route
     */
    protected $route;

    public function setUp()
{
    $this->route = new Route(
        '',
        'Vitaminate\Tests\Vitaminate\Http\Controllers\FakeController@detail',
        []
    );
}

    public function testCanGetAndSet()
    {
        $this->route
            ->setController('test_controller')
            ->setActionArguments(['test_argument'])
            ->addActionArgument('second_argument')
        ;

        $this->assertEquals('test_controller', $this->route->getController());
        $this->assertContains('test_argument', $this->route->getActionArguments());
        $this->assertContains('second_argument', $this->route->getActionArguments());
        $this->assertInstanceOf(URL::class, $this->route->getUrl());
    }

    public function testCanRunControllerAction()
    {
        $this->expectOutputString('detail action');
        echo $this->route->runAction();
    }

    public function testCanThrowExceptionWhenActionDoesNotExist()
    {
        $this->expectException(InvalidCallableException::class);
        $route = new Route('',0,[]);
        $route->runAction();
    }

    public function testCanCallAClosureAction()
    {
        $this->expectOutputString('closure');
        $route = new Route('',function(){ echo 'closure'; },[]);
        $route->runAction();
    }
}