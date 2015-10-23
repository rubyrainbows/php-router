<?php

/**
 * Route.php
 *
 * @author    Thomas Muntaner thomas.muntaner@gmail.com
 * @copyright 2014 Thomas Muntaner
 * @version   1.0.0
 */

namespace RubyRainbows\Router;

use RubyRainbows\Router\Core\Exceptions\RouterMissingParametersException;
use RubyRainbows\Router\Core\Exceptions\RouterNotFoundException;
use RubyRainbows\Router\Core\RouteArray;
use RubyRainbows\Router\Core\RouteCleaner;
use RubyRainbows\Router\Core\RouteJoiner;

/**
 * Class Router
 *
 * This class interfaces with route classes as a front end api
 *
 * @package RubyRainbows\Router
 */
class Router
{
    /**
     * @var RouteArray
     */
    private $routeArray;

    /**
     * @var RouteCleaner
     */
    private $routeCleaner;

    /**
     * @var RouteJoiner
     */
    private $routeJoiner;

    /**
     * @param array $routes An array of routes
     */
    public function __construct ( $routes )
    {
        $this->routeArray = new RouteArray($routes);
        $this->routeCleaner = new RouteCleaner();
        $this->routeJoiner = new RouteJoiner();
    }

    /**
     * Creates a route from the route array with parameters
     *
     * @param string $name
     * @param array  $params
     *
     * @return string
     *
     * @throws RouterMissingParametersException
     * @throws RouterNotFoundException
     */
    public function getRoute ( $name, $params = [] )
    {
        $route = $this->routeArray->getRoute($name);

        return $this->routeCleaner->cleanRoute($route, $params);
    }

    /**
     * Joins multiple routes together
     *
     * @param array $routes
     * @param array $parameters
     *
     * @return string
     */
    public function joinRoutes ( $routes, $parameters = [] )
    {
        $route = $this->routeJoiner->join($routes);

        return $this->generateRoute($route, $parameters);
    }

    /**
     * Returns a url with the current uri and parameters
     *
     * @param array $params
     *
     * @return string
     */
    public function getCurrentRouteURL ( $params = [] )
    {
        $route = strtok($_SERVER['REQUEST_URI'], '?');

        return $this->generateRoute($route, $params);
    }

    /**
     * Takes the route and adds
     *
     * @param string $route
     * @param array  $params
     *
     * @return string
     * @throws RouterMissingParametersException
     */
    private function generateRoute ( $route, $params = [] )
    {
        return $this->routeCleaner->cleanRoute($route, $params);
    }
}
