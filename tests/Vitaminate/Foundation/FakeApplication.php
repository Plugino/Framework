<?php

namespace Vitaminate\Tests\Vitaminate\Foundation;

use Vitaminate\Foundation\Application;
use Vitaminate\Tests\Vitaminate\Http\FakeRequest;
use Vitaminate\Tests\Vitaminate\Routing\FakeRouter;

class FakeApplication extends Application
{
    public function bindTestUtilities()
    {
        $request = new FakeRequest();
        $router = new FakeRouter($this);

        $this->instance('router', $router);
        $this->instance('request', $request);
    }
}