<?php

namespace Vitaminate\Tests\Vitaminate\Routing;


use PHPUnit\Framework\TestCase;
use Vitaminate\Routing\AdminRoute;

class AdminRouteTest extends TestCase
{
    /**
     * @var AdminRoute $adminRoute;
     */
    protected $adminRoute;

    public function setUp()
    {
        $this->adminRoute = new AdminRoute(
            'Vitaminate\Tests\Vitaminate\Http\Controllers\FakeController@detail',
            []
        );
    }

    public function testThePathIsCorrectlyDefined()
    {
        $this->assertEquals('/wp-admin/admin.php', $this->adminRoute->getUrl()->getPath());
    }
}