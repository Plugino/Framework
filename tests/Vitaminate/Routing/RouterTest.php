<?php

namespace Vitaminate\Tests\Vitaminate\Routing;

use PHPUnit\Framework\TestCase;
use Vitaminate\Routing\Exceptions\RouteNotFoundException;
use Vitaminate\Routing\Route;
use Vitaminate\Routing\RouteCollection;
use Vitaminate\Routing\Router;
use Vitaminate\Routing\URL;
use Vitaminate\Tests\Vitaminate\Foundation\FakeApplication;

class RouterTest extends TestCase
{
    /**
     * @var FakeApplication $fakeApp
     */
    protected $fakeApp;
    /**
     * @var Router $router
     */
    protected $router;

    protected function setUp()
    {

        $this->fakeApp = new FakeApplication();
        $this->fakeApp->bindTestUtilities();

        $this->router = new FakeRouter($this->fakeApp);
    }

    public function testCanGenerateAnUrl()
    {
        $this->assertInstanceOf(URL::class, $this->router->generateUrl('fake'));
    }

    public function testCanCallActionOfMatchedRoute()
    {
        $this->expectOutputString('detail action');
        echo $this->router->run();
    }

    public function testCanThrowNotFoundRouteException()
    {
        $this->expectException(RouteNotFoundException::class);

        $collection = new RouteCollection();
        $collection->add('fake',
            new Route(
                '',
                'Vitaminate\Tests\Vitaminate\Http\Controllers\FakeController@detail',
                []
            )
        );
        $router = new Router($collection, $this->fakeApp);
        $router->run();
    }
}