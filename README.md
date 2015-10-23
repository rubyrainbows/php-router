[![Latest Stable Version](https://poser.pugx.org/rubyrainbows/router/version.svg)](https://packagist.org/packages/rubyrainbows/router)
[![Total Downloads](https://poser.pugx.org/rubyrainbows/router/downloads.svg)](https://packagist.org/packages/rubyrainbows/router)
[![Build Status](https://travis-ci.org/rubyrainbows/php-router.svg?branch=master)](https://travis-ci.org/rubyrainbows/php-router)

# PHP Router

This library adds some helpful functions to work with routes.

* Storage and use of named routes.
* The cleaning of routes with template variables.
* The joining of multiple route parts together to form a complete URL.

### A Note about Stored Routes

In order to be able to use the stored routes functionality, you will need to have a php file which returns an array of routes.
In this array, you can have plain routes or routes with template variables designated with a `:`, e.g. `:foo`.

routes.php
```php
<?php

return [
    'home' => '/',
    'profile' => '/profile',
    'blog_entry' => '/blog_entry/:entry'
];
```

### Usage

```php
<?php

use RubyRainbows\Router\Router;

// If not using stored routes.
$router = new Router();

// If using stored routes.
$routes = require '/location/of/routes.php'
$router = new Router($routes);

/**
 * Getting a stored route
 */

$route = $router->getRoute('home');
// returns /'profile'

$route = $router->getRoute('home', ['foo' => 'bar']);
// returns '/profile?foo=bar'

$route = $router->getRoute('blog_entry');
// throws a RouterMissingParameterException because the 'blog_entry' parameter is missing

$route = $router->getRoute('blog_entry', ['entry' => 'awesome_blog_entry']);
// returns '/blog_entry/awesome_blog_entry'

/**
 * Joining routes
 */
 
$route = $router->joinRoutes('/foo', '/bar');
// returns '/foo/bar'

$route = $router->joinRoutes('/foo', '/bar', ['foo' => 'bar']);
// returns '/foo/bar?foo=bar'

$route = $router->joinRoutes('/foo', 'https://www.foo.com');
// throws RouterInvalidJoinException as the url would be '/foo/https://www.foo.com

/**
 * Working with the current route URL
 *
 * For this example, the current url 'http://www.example.com/profile'
 */

$route = $router->getCurrentRouteURL(['foo' => 'bar']);
// returns '/profile?foo=bar'
```