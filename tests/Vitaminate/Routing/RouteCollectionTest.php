<?php

namespace Vitaminate\Tests\Vitaminate\Routing;

use PHPUnit\Framework\TestCase;
use Vitaminate\Routing\Route;
use Vitaminate\Routing\RouteCollection;

class RouteCollectionTest extends TestCase
{
    /**
     * @var RouteCollection $routeCollection
     */
    protected $routeCollection;

    /**
     * @var Route $fakeRoute
     */
    protected $fakeRoute;

    public function setUp()
    {
        $this->routeCollection = new RouteCollection();
        $this->fakeRoute = new Route(
            '',
            'Vitaminate\Tests\Vitaminate\Http\Controllers\FakeController@detail',
            []
        );
    }

    public function testCanGetAndSet()
    {
        $this->routeCollection
            ->add('fake', $this->fakeRoute)
            ->add('fake2', $this->fakeRoute)
            ->remove('fake2')
        ;

        $this->assertInstanceOf(Route::class, $this->routeCollection->get('fake'));
        $this->assertNull($this->routeCollection->get('fake2'));
        $this->assertArrayHasKey('fake', $this->routeCollection->getRoutes());

        $this->routeCollection->setRoutes([]);
        $this->assertEquals([], $this->routeCollection->getRoutes());
    }
}