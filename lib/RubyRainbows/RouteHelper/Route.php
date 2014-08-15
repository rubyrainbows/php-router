<?php

namespace RubyRainbows\RouteHelper;

class Route
{
    private $routeArray;
    private $routeCleaner;

    public function __construct ( $routePath, $routeArray = null, $routeCleaner = null )
    {
        $this->routeArray   = ( $routeArray != null ) ? $routeArray : new RouteArray( $routePath ) ;
        $this->routeCleaner = ( $routeCleaner != null ) ? $routeCleaner : new RouteCleaner();
    }

    public function route ( $name, $params=[] )
    {
        $route = $this->routeArray->getRoute( $name );

        return $this->routeCleaner->makeRoute( $route, $params );
    }
}
