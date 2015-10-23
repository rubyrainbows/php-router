<?php

/**
 * RouteArray.php
 *
 * @author    Thomas Muntaner thomas.muntaner@gmail.com
 * @copyright 2014 Thomas Muntaner
 * @version   1.0.0
 */

namespace RubyRainbows\Router\Core;

use RubyRainbows\Router\Core\Exceptions\RouterNotFoundException;

/**
 * Class RouteArray
 *
 * This class gets the routes from a route file and
 * returns/finds them.
 *
 * @package RubyRainbows\Router\Core
 */
class RouteArray
{
    /**
     * @var array
     */
    private $routes;

    /**
     * @param array $routes An array of routes
     */
    public function __construct ( $routes )
    {
        $this->routes = $routes;
    }

    /**
     * Returns all the routes
     *
     * @return array The routes
     */
    public function getRoutes ()
    {
        return $this->routes;
    }

    /**
     * Returns a route by its name
     *
     * @param  string $name The name of the route
     *
     * @return string The Route
     * @throws RouterNotFoundException
     */
    public function getRoute ( $name )
    {
        if ( array_key_exists($name, $this->routes) )
            return $this->routes[$name];

        throw new RouterNotFoundException();
    }
}
