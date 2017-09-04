<?php

namespace Vitaminate\Tests\Vitaminate\Routing;


use Vitaminate\Foundation\Application;
use Vitaminate\Routing\Route;
use Vitaminate\Routing\RouteCollection;
use Vitaminate\Routing\Router;

class FakeRouter extends Router
{
    public function __construct(Application $app)
    {
        $collection = new RouteCollection();
        $collection->add('fake',
            new Route(
                '/wp-admin.php',
                'Vitaminate\Tests\Vitaminate\Http\Controllers\FakeController@detail',
                [
                    'page' => 'test'
                ]
            )
        );
        parent::__construct($collection, $app);
    }
}