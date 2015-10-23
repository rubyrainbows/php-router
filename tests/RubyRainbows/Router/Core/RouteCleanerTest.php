<?php

use RubyRainbows\Router\Core\RouteCleaner;

class RouteCleanerTest extends TestCase
{
    /**
     * @var RouteCleaner
     */
    private $routeCleaner;

    public function setUp ()
    {
        parent::setUp();

        $this->routeCleaner = new RouteCleaner();
    }

    public function testMakeRoute ()
    {
        $params = ['id' => 'bar', 'param1' => 'foo1', 'param2' => 'foo2'];

        $this->assertEquals('/foo/bar?param1=foo1&param2=foo2', $this->routeCleaner->cleanRoute('/foo/:id', $params));
    }

    /**
     * @expectedException RubyRainbows\Router\Core\Exceptions\RouterMissingParametersException
     * @expectedExceptionMessage Route is missing a required parameter: :bar.
     */
    public function testMakeRouteWithOneMissingRequiredParameter ()
    {
        $params = ['id' => 'bar', 'param1' => 'foo1', 'param2' => 'foo2'];

        $this->routeCleaner->cleanRoute('/foo/:id/:bar', $params);
    }
}
