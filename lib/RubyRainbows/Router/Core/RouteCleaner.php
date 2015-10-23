<?php

/**
 * RouteCleaner.php
 *
 * @author    Thomas Muntaner thomas.muntaner@gmail.com
 * @copyright 2014 Thomas Muntaner
 * @version   1.0.0
 */

namespace RubyRainbows\Router\Core;

use RubyRainbows\Router\Core\Exceptions\RouterMissingParametersException;

/**
 * Class RouteCleaner
 *
 * This class cleans a route before handing it off to the consumer.
 *
 * @package RubyRainbows\Router\Core
 */
class RouteCleaner
{
    /**
     * This method takes a route with parameters and returns the cleaned route.
     *
     * E.g. /foo?bar=:bar with params ['bar' => 'foo'] would create /foo?bar=foo
     *
     * @param string $dirtyRoute
     * @param array  $params
     *
     * @return string
     * @throws RouterMissingParametersException
     */
    public function cleanRoute ( $dirtyRoute, $params )
    {
        $additional = [];

        foreach ( $params as $key => $value )
        {
            if ( strpos($dirtyRoute, ":{$key}") === false )
            {
                $additional[$key] = $value;
            }
            else
            {
                $dirtyRoute = str_replace(":{$key}", $value, $dirtyRoute);
            }
        }

        $missingParameters = $this->findMissingParameters($dirtyRoute);

        if ( $missingParameters != [] )
        {
            throw new RouterMissingParametersException($missingParameters);
        }

        if ( $additional == [] )
           return $dirtyRoute;

        return $dirtyRoute . '?' . http_build_query($additional);
    }

    /**
     * This function finds missing parameters in the cleaning process
     *
     * @param string $route
     *
     * @return array
     */
    private function findMissingParameters ( $route )
    {
        $missingParameters = [];

        if ( strpos($route, ":") !== false )
        {
            preg_match('/:[a-zA-Z0-9]*/', $route, $missingParameters);
        }

        return $missingParameters;
    }
}
