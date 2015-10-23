<?php

require_once __DIR__ . '/../vendor/autoload.php';

class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    protected $fixturesPath;

    /**
     * @var array
     */
    protected $routes;

    public function setUp ()
    {
        $this->routes = require dirname(__FILE__) . '/fixtures/routes.php';
    }

    public function tearDown ()
    {
        Mockery::close();
    }

    protected function mock ( $object )
    {
        return Mockery::mock($object);
    }
}
