<?php

use RubyRainbows\RouteHelper\RouteArray as RouteArray;

class RouteArrayTest extends TestCase
{
    private $routeArray;

    public function setUp ()
    {
        parent::setUp();

        $this->routeArray = new RouteArray( $this->fixturesPath . '/routes.php' );
    }

    public function test ()
    {
        $expected = [
            'foo' => '/foo'
        ];

        $this->assertEquals( $expected, $this->routeArray->getRoutes() );
    }

    public function testMissingGetRoute ()
    {
        $this->setExpectedException( 'RubyRainbows\RouteHelper\RouteNotFoundException' );

        $this->routeArray->getRoute( 'foo-missing' );
    }

    public function testGetRoute ()
    {
        $this->assertEquals( '/foo', $this->routeArray->getRoute( 'foo' ) );
    }
}
