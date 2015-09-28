<?php

/**
 * RouteTemplateCleaner.php
 *
 * @author    Thomas Muntaner thomas.muntaner@gmail.com
 * @copyright 2014 Thomas Muntaner
 * @version   1.0.0
 */

namespace RubyRainbows\RouteHelper;

use RubyRainbows\RouteHelper\Exceptions\RouteMissingParameterException as ParamMissing;

/**
 * Class RouteTemplateCleaner
 *
 * Cleans a template route from the route array and returns a proper route
 *
 * @package RubyRainbows\RouteHelper
 */
class RouteTemplateCleaner
{
    /**
     * C
     * @param $dirtyRoute
     * @param $params
     * @return string
     * @throws ParamMissing
     */
    public function makeRoute ( $dirtyRoute, $params )
    {
        $additional = [];

        foreach( $params as $key => $value )
        {
            if ( strpos( $dirtyRoute, ":{$key}" ) === false )
            {
                $additional[$key] = $value;
            }
            else
            {
                $dirtyRoute = str_replace( ":{$key}", $value, $dirtyRoute );
            }
        }

        if ( strpos( $dirtyRoute, ":" ) !== false )
        {
            preg_match('/:[a-zA-Z0-9]*/', $dirtyRoute, $param );
            throw new ParamMissing( ltrim($param[0], ':') );
        }

        return $dirtyRoute . '?' . http_build_query( $additional );
    }
}
