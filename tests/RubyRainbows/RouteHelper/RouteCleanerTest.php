<?php

use RubyRainbows\RouteHelper\RouteTemplateCleaner;

class RouteCleanerTest extends TestCase
{
    private $routeCleaner;

    public function setUp ()
    {
        parent::setUp();

        $this->routeCleaner = new RouteTemplateCleaner();
    }

    public function testMakeRoute ()
    {
        $params = ['id' => 'bar', 'param1' => 'foo1', 'param2' => 'foo2'];

        $this->assertEquals( '/foo/bar?param1=foo1&param2=foo2', $this->routeCleaner->makeRoute( '/foo/:id', $params) );
    }

    /**
     *  @expectedException RubyRainbows\RouteHelper\Exceptions\RouteMissingParameterException
     *  @expectedExceptionMessage Route is missing a required parameter: bar.
     */
    public function testMakeRouteWithOneMissingRequiredParameter ()
    {
        $params = ['id' => 'bar', 'param1' => 'foo1', 'param2' => 'foo2'];

        $this->routeCleaner->makeRoute( '/foo/:id/:bar', $params);
    }
}
