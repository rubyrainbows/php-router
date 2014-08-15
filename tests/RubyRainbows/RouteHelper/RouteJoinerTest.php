<?php

use RubyRainbows\RouteHelper\RouteJoiner as RouteJoiner;

class RouteJoinerTest extends TestCase
{
    private $routeJoiner;

    public function setUp ()
    {
        parent::setUp();

        $this->routeJoiner = new RouteJoiner();
    }

    /**
     * @dataProvider joinProvider
     */
    public function testJoin ( $expected, $routes )
    {
        $this->assertEquals( $expected, $this->routeJoiner->join( $routes ) );
    }

    /**
     * @dataProvider invalidJoinProvider
     * 
     * @expectedException RubyRainbows\RouteHelper\Exceptions\InvalidRouteJoinException
     */
    public function testInvalidJoin ( $routes )
    {
        $this->routeJoiner->join( $routes );
    }

    public function joinProvider ()
    {
        return [
            ['/foo/bar', ['/foo', '/bar']],
            ['/foo/bar', ['/foo/', '/bar']],
            ['/foo/bar', ['/foo/', 'bar']]
        ];
    }

    public function invalidJoinProvider ()
    {
        return [
            [['/foo?', '/bar']],
            [['/foo?bar=foo', '/bar']],
            [['/foo', 'http://bar']],
            [['/foo', 'https://bar']],
        ];
    }
}
