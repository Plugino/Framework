<?php

namespace Vitaminate\Tests\Vitaminate\Routing;

use PHPUnit\Framework\TestCase;
use Vitaminate\Routing\URL;

class URLTest extends TestCase
{
    /**
     * @var URL $url
     */
    protected $url;

    public function setUp()
    {
        $this->url = new URL();
    }

    public function testGettersAndSetters()
    {
        $this->url
            ->setPath('path_test')
            ->setParameters(['parameter' => 'test'])
        ;

        $this->assertEquals('path_test', $this->url->getPath());
        $this->assertArrayHasKey('parameter', $this->url->getParameters());
    }

    public function testCanManipulateParameters()
    {
        $this->url
            ->addParameter('key', 'value')
            ->addParameter('key2', 'value2')
            ->removeParameter('key2')
        ;

        $this->assertEquals('value', $this->url->getParameter('key'));
        $this->assertTrue(!$this->url->hasParameter('key2'));
        $this->assertNull($this->url->getParameter('key2'));
    }

    public function testCanHandleStaticContext()
    {
        $this->assertInstanceOf(URL::class, URL::getInstance());
    }

    public function testCanEchoAnEmptyInstance()
    {
        $this->expectOutputString('');
        echo $this->url;
    }

    public function testCanEchoAnFullyInstance()
    {
        $this->url
            ->addParameter('key', 'value')
        ;

        $this->expectOutputString('?key=value');
        echo $this->url;
    }

    public function testCanGenerateUrl()
    {
        $this->assertInstanceOf(URL::class, URL::to('fake'));
    }

    public function testCanAddParametersWithWithMethod()
    {
        $this->expectOutputString('?page=test&id=0');
        echo URL::to('fake')->with('id', 0);
    }

    public function testCanAddParametersWithArrayArgument()
    {
        $this->expectOutputString('?page=test&id=0&action=delete');
        echo URL::to('fake')->with(['id' => 0, 'action' => 'delete']);
    }
}