<?php

use RubyRainbows\Router\Router;

class RouteTest extends TestCase
{
    /**
     * @var Router
     */
    private $route;

    public function setUp ()
    {
        parent::setUp();

        $this->route = new Router($this->routes);
    }

    public function testGetRoute ()
    {
        $params = ['foo' => 'bar'];
        $name = 'foo';

        $route = $this->route->getRoute($name, $params);

        $this->assertEquals('/foo?foo=bar', $route);
    }

    public function testJoin ()
    {
        $routes = ['/foo', '/bar'];

        $route = $this->route->joinRoutes($routes);

        $this->assertEquals('/foo/bar', $route);
    }

    public function testGetCurrentRoute ()
    {
        $root = '/foo/bar';

        $_SERVER['REQUEST_URI'] = "{$root}?foo=bar";

        $current = $this->route->getCurrentRouteURL();
        $this->assertEquals($root, $current);
    }
}
