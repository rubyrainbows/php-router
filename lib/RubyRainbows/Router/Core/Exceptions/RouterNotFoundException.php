<?php

/**
 * RouterNotFoundException.php
 *
 * @author    Thomas Muntaner thomas.muntaner@gmail.com
 * @copyright 2014 Thomas Muntaner
 * @version   1.0.0
 */

namespace RubyRainbows\Router\Core\Exceptions;

use Exception;

/**
 * Class RouterNotFoundException
 *
 * An exception for route issues
 *
 * @package RubyRainbows\Router\Core\Exceptions
 */
class RouterNotFoundException extends Exception
{
    /**
     * @param int            $code
     * @param Exception|null $previous
     */
    public function __construct ( $code = 0, Exception $previous = null )
    {
        parent::__construct('Route Not Found', $code, $previous);
    }
}
