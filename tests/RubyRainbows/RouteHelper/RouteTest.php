<?php

use RubyRainbows\RouteHelper\Route as Route;

class RouteTest extends TestCase
{
    private $route;
    private $routePath;
    private $rotueArray;
    private $routeCleaner;

    public function setUp ()
    {
        parent::setUp();

        $this->routeArray   = $this->mock( 'RubyRainbows\RouteHelper\RouteArray' );
        $this->routeCleaner = $this->mock( 'RubyRainbows\RouteHelper\RouteCleaner' );

        $this->route = new Route( $this->fixturesPath . '/routes.php', $this->routeArray, $this->routeCleaner );
    }

    public function testGetRoute ()
    {
        $params = ['foo' => 'bar'];
        $name   = 'foo';

        $this->routeArray->shouldReceive('getRoute')->once()->with($name)->andReturn('/foo/bar');
        $this->routeCleaner->shouldReceive('makeRoute')->once()->with('/foo/bar', $params)->andReturn('/foo/bar');
        
        $this->route->route( $name, $params );
    }
}
