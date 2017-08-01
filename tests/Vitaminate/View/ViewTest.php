<?php

namespace Vitaminate\Tests\Vitaminate\View;

use PHPUnit\Framework\TestCase;
use Vitaminate\View\View;

class ViewTest extends TestCase
{
    /**
     * @var string
     */
    protected $viewsPath;
    /**
     * @var View
     */
    protected $view;

    public function setUp(){
        $this->viewsPath = realpath(__DIR__ . '/../../resources/views' );
        $this->view = new View($this->viewsPath);
    }

    public function testCanGetAndSetAttributes(){
        $attributes = array('test' => 'test');
        $this->view->setAttributes($attributes);
        $this->view->addAttribute('test_2', 'second test');

        $this->assertArrayHasKey('test', $this->view->getAttributes());
        $this->assertEquals('second test', $this->view->getAttribute('test_2'));
    }

    public function testUndefinedAttributesReturnFalse(){
        $this->assertTrue(!$this->view->getAttribute('undefined_attribute'));
    }

    public function testCanThrowExceptionWhenTheTemplateIsntAvailable(){
        $this->expectException(\RuntimeException::class);

        $this->view->load('unavailable_template');
    }

    public function testCanHandleExceptionWhenTryingToIncludeTheView(){
        $this->expectException(\Exception::class);

        $view = $this->getMockBuilder(View::class)
            ->setConstructorArgs([$this->viewsPath])
            ->setMethods(['protectedIncludeScope'])
            ->getMock()
        ;

        $view->method('protectedIncludeScope')
            ->will($this->throwException(new \Exception))
        ;

        $view->load('test');
    }

    public function testCanLoadAView(){
        $this->expectOutputString('test view');
        $this->view->load('test');
    }

    public function testThrowExceptionWhenThereIsNoFileToLoad(){
        $this->expectException(\RuntimeException::class);
        $this->view->load('');
    }
}