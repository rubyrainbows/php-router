<?php

/**
 * RouterMissingParametersException.php
 *
 * @author    Thomas Muntaner thomas.muntaner@gmail.com
 * @copyright 2014 Thomas Muntaner
 * @version   1.0.0
 */

namespace RubyRainbows\Router\Core\Exceptions;

use Exception;

/**
 * Class RouterMissingParametersException
 *
 * An exception for route issues
 *
 * @package RubyRainbows\Router\Core\Exceptions
 */
class RouterMissingParametersException extends Exception
{
    /**
     * @param array          $parameters
     * @param int            $code
     * @param Exception|null $previous
     */
    public function __construct ( $parameters, $code = 0, Exception $previous = null )
    {
        $parameterString = join(' ', $parameters);

        parent::__construct("Route is missing a required parameter: {$parameterString}.", $code, $previous);
    }
}
