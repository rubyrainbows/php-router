<?php

/**
 * RouteArray.php
 *
 * @author    Thomas Muntaner thomas.muntaner@gmail.com
 * @copyright 2014 Thomas Muntaner
 * @version   1.0.0
 */

namespace RubyRainbows\RouteHelper;

/**
 * Class Route
 *
 * This class interfaces with route classes to make routes
 *
 * @package RubyRainbows\RouteHelper
 */

class Route
{
    /**
     * @var RouteArray
     */
    private $routeArray;

    /**
     * @var RouteTemplateCleaner
     */
    private $routeCleaner;

    /**
     * @var RouteJoiner
     */
    private $routeJoiner;

    public function __construct ( $routePath, $routeArray = null, $routeCleaner = null, $routeJoiner = null )
    {
        $this->routeArray   = ( $routeArray != null ) ? $routeArray : new RouteArray( $routePath ) ;
        $this->routeCleaner = ( $routeCleaner != null ) ? $routeCleaner : new RouteTemplateCleaner();
        $this->routeJoiner  = ( $routeJoiner != null ) ? $routeJoiner : new RouteJoiner();
    }

    /**
     * Creates a route from the route array with parameters
     *
     * @param $name
     * @param array $params
     *
     * @return string
     *
     * @throws Exceptions\RouteMissingParameterException
     * @throws Exceptions\RouteNotFoundException
     */
    public function route ( $name, $params=[] )
    {
        $route = $this->routeArray->getRoute( $name );

        return $this->routeCleaner->makeRoute( $route, $params );
    }

    /**
     * Joins multiple routes together
     *
     * @param $routes
     *
     * @return string
     */
    public function join ( $routes )
    {
        return $this->routeJoiner->join ( $routes );
    }
}
