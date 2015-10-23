<?php

use RubyRainbows\Router\Core\RouteArray;

class RouteArrayTest extends TestCase
{
    private $routeArray;

    public function setUp ()
    {
        parent::setUp();

        $this->routeArray = new RouteArray($this->routes);
    }

    public function testGetRoutes ()
    {
        $expected = [
            'foo' => '/foo'
        ];

        $this->assertEquals($expected, $this->routeArray->getRoutes());
    }

    /**
     * @expectedException RubyRainbows\Router\Core\Exceptions\RouterNotFoundException
     */
    public function testMissingGetRoute ()
    {
        $this->routeArray->getRoute('foo-missing');
    }

    public function testGetRoute ()
    {
        $this->assertEquals('/foo', $this->routeArray->getRoute('foo'));
    }
}
