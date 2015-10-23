<?php

/**
 * RouterInvalidJoinException.php
 *
 * @author    Thomas Muntaner thomas.muntaner@gmail.com
 * @copyright 2014 Thomas Muntaner
 * @version   1.0.0
 */

namespace RubyRainbows\Router\Core\Exceptions;

use Exception;

/**
 * Class RouterInvalidJoinException
 *
 * An exception for route joining issues
 *
 * @package RubyRainbows\Router\Core\Exceptions
 */
class RouterInvalidJoinException extends Exception
{
    /**
     * @param string         $route1
     * @param int            $route2
     * @param int            $code
     * @param Exception|null $previous
     */
    public function __construct ( $route1, $route2, $code = 0, Exception $previous = null )
    {
        parent::__construct("Invalid Route Join: {$route1} with {$route2}", $code, $previous);
    }
}
