<?php

namespace Vitaminate\Tests\Vitaminate\Routing;

use PHPUnit\Framework\TestCase;
use Vitaminate\Http\Request;
use Vitaminate\Routing\Route;
use Vitaminate\Routing\RouteCollection;
use Vitaminate\Routing\RouteMatcher;
use Vitaminate\Tests\Vitaminate\Http\FakeRequest;

class RouteMatcherTest extends TestCase
{
    /**
     * @var RouteMatcher $routeMatcher
     */
    protected $routeMatcher;

    /**
     * @var RouteCollection $fakeRouteCollection
     */
    protected $fakeRouteCollection;

    /**
     * @var Request $fakeRequestObject
     */
    protected $fakeRequestObject;


    protected function setUp()
    {
        $this->routeMatcher = new RouteMatcher();
        $this->fakeRequestObject = new FakeRequest();
        $this->fakeRouteCollection = new RouteCollection();

        // Seeds the fake route collection
        $this->fakeRouteCollection
            ->add('fake',
                new Route(
                    '/wp-admin.php',
                    'Vitaminate\Tests\Vitaminate\Http\Controllers\FakeController@detail',
                    [
                        'page' => 'test'
                    ]
                )
        );

        // Arrange our fake request object
        $this->fakeRequestObject->query->set('page', 'test');
    }

    public function testCanMatchARoute()
    {
        $this->assertInstanceOf(Route::class, $this->routeMatcher->getRoute($this->fakeRequestObject, $this->fakeRouteCollection));
    }
}