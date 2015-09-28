<?php

/**
 * RouteJoiner.php
 *
 * @author    Thomas Muntaner thomas.muntaner@gmail.com
 * @copyright 2014 Thomas Muntaner
 * @version   1.0.0
 */

namespace RubyRainbows\RouteHelper;

use RubyRainbows\RouteHelper\Exceptions\InvalidRouteJoinException as InvalidJoin;

/**
 * Class RouteJoiner
 *
 * This class joins multiple routes together
 *
 * @package RubyRainbows\RouteHelper
 */
class RouteJoiner
{
    private $invalidJoin1 = ['?', '&', '='];
    private $invalidJoin2 = ['http', 'https'];

    /**
     * Joins multiple route parts together
     *
     * @param $routes
     *
     * @return string
     *
     * @throws InvalidJoin
     */
    public function join ( $routes )
    {
        $routeString = '';

        foreach ( $routes as $route )
            $routeString = $this->appendRoute( $routeString, $route );

        return $routeString;
    }

    /**
     * Appends two route strings together
     *
     * @param $base
     * @param $appended
     *
     * @return string
     *
     * @throws InvalidJoin
     */
    private function appendRoute ( $base, $appended )
    {
        if ( $base == '' )
            return $appended;

        if ( !$this->isValidJoin( $base, $appended) )
            throw new InvalidJoin( $base, $appended );

        if ( ( substr( $base, -1) == substr( $appended, 0,1 ) ) && substr( $appended, 0,1 ) == '/' ) // check /+/
            return $base . substr( $appended, 1 );

        if ( (substr( $base, -1) != '/') && substr( $appended, 0,1 ) != '/' ) // check if no / between the two routes
            return $base . '/' . $appended;

        return $base . $appended;
    }

    /**
     * Checks if the two routes being joined is a valid route
     * join
     *
     * @param $route1
     * @param $route2
     *
     * @return bool
     */
    private function isValidJoin ( $route1, $route2 )
    {
        foreach ( $this->invalidJoin1 as $invalid )
        {
            if ( strpos( $route1, $invalid ) !== false )
                return false;
        }

        foreach ( $this->invalidJoin2 as $invalid )
        {
            if ( strpos( $route2, $invalid ) !== false )
                return false;
        }

        return true;
    }
}
