<?php

namespace Vitaminate\Tests\Vitaminate\Routing;

use PHPUnit\Framework\TestCase;
use Vitaminate\Routing\Redirect;

class RedirectTest extends TestCase
{
	public function setUp()
	{

	}

	public function testCanHandleARedirection()
	{
		$this->assertEquals('Redirect to fake', Redirect::to('fake'));
	}
}