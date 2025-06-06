<?php

declare(strict_types=1);

use Aura\Router\RouterContainer;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\ServerRequestFactory;

ini_set('display_errors', '1');

require_once __DIR__ . '/../vendor/autoload.php';

$routerContainer = new RouterContainer();

$request = ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

$map = $routerContainer->getMap();

$map->get('home', '/', function () {
    return new HtmlResponse('This tuts rocks!!!');
});

$map->get('about', '/about', function () {
    return new HtmlResponse('This is the about page!!!');
});

$map->get('contact', '/contact', function () {
    return new HtmlResponse('This is the contact page!!!');
});

$map->get('blog_slug', '/blog/{slug}', function ($request) {
    // Get the slug from the route attributes
    $slug = (string) $request->getAttribute('slug');
    $html = 'This is the blog page for ' . $slug . '!!!';
    return new HtmlResponse($html);
});

// match the request
$matcher = $routerContainer->getMatcher();
$route = $matcher->match($request);

// if no route registered for current path, it can be a 404 error, or 405, 406, etc.
if (!$route) {
    // get the first of the best-available non-matched routes
    $failedRoute = $matcher->getFailedRoute();

    // we need to handle the failed route
    match ($failedRoute->failedRule) {
        // if method was not allowed (e.g., received GET request on a POST route)
        'Aura\Router\Rule\Allows' => (function () {
                // 405 METHOD NOT ALLOWED
                http_response_code(405);
                echo '405 METHOD NOT ALLOWED';
            })(),
        // if content type was not accepted (e.g. received HTML request on a JSON route)
        'Aura\Router\Rule\Accepts' => (function () {
                // 406 NOT ACCEPTABLE
                http_response_code(406);
                echo '406 NOT ACCEPTABLE';
            })(),
        // handle as a 404 error for other cases
        default => (function () {
                // 404 NOT FOUND
                http_response_code(404);
                echo '404 NOT FOUND!';
            })()
    };

    exit;
}

// add route attributes to the request so we need not pass $router to handlers as well
foreach ($route->attributes as $key => $val) {
    $request = $request->withAttribute($key, $val);
}

// dispatch the route
$handler = $route->handler; // get the callable function we defined for each route
$response = $handler($request); // run the function and pass the request object to it for further usage in the function

// emit the response
foreach ($response->getHeaders() as $name => $values) {
    foreach ($values as $value) {
        header(sprintf('%s: %s', $name, $value), false);
    }
}
http_response_code($response->getStatusCode());
echo $response->getBody();
