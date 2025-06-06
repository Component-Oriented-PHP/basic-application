<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

$routerContainer = new \Aura\Router\RouterContainer();

$request = \Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

$map = $routerContainer->getMap();

$map->get('home', '/', function () {
    echo 'This tuts rocks!!!';
});

$map->get('about', '/about', function () {
    echo 'This is the about page!!!';
});

$map->get('contact', '/contact', function () {
    echo 'This is the contact page!!!';
});

$map->get('blog_slug', '/blog/{slug}', function ($request, $route) {
    // Get the slug from the route attributes
    $slug = (string) $route->attributes['slug'];
    echo 'This is the blog page for ' . $slug;
});

// match the request
$matcher = $routerContainer->getMatcher();
$route = $matcher->match($request);

// if no route registered for current path
if (!$route) {
    http_response_code(404);
    echo '404';
    exit;
}

// dispatch the route
$handler = $route->handler; // get the callable function we defined for each route
$handler($request, $route); // run the function and pass the request object to it for further usage in the function
