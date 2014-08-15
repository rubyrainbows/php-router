<?php

/**
 * RouteMissingParameterException.php
 *
 * @author    Thomas Muntaner thomas.muntaner@gmail.com
 * @copyright 2014 Thomas Muntaner
 * @version   1.0.0
 */

namespace RubyRainbows\RouteHelper\Exceptions;

/**
 * Class RouteMissingParameterException
 *
 * An exception for route issues
 *
 * @package RubyRainbows\RouteHelper\Exceptions
 */
class RouteMissingParameterException extends \Exception
{
    public function __construct( $parameter, $code = 0, Exception $previous = null )
    {
        parent::__construct( "Route is missing a required parameter: {$parameter}.", $code, $previous );
    }
}
