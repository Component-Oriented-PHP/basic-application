<?php

declare(strict_types=1);

use App\Library\View\RendererInterface;
use App\Library\View\TwigRenderer;
use Aura\Router\RouterContainer;
use Auryn\Injector;
use Dikki\DotEnv\DotEnv;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\ServerRequestFactory;

require_once __DIR__ . '/../vendor/autoload.php';

(new DotEnv(__DIR__ . '/../'))->load();

// Initialize Whoops for better error handling
if (getenv('APP_ENV') === 'development') {
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
}

// DI
$container = new Injector();

# register services
// this tells the container: "When someone asks for RendererInterface, give them TwigRenderer"
$container->alias(RendererInterface::class, TwigRenderer::class);

// OR: to use PlatesRenderer instead, uncomment the line below and comment the one above
// $injector->alias(RendererInterface::class, \App\Library\View\PlatesRenderer::class);

// Router
$routerContainer = new RouterContainer();

$request = ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

$map = $routerContainer->getMap();

//map the route definitions
$routes = require_once __DIR__ . '/../config/routes.php';
foreach ($routes as $name => $route) {
    $requestMethod = $route[0];
    $path = $route[1];
    $handler = explode('::', $route[2]);
    $controller = $handler[0];
    $method = $handler[1];

    // we need to make use of DI container to pass the necessary services to controller for usage
    $map->$requestMethod($name, $path, function ($request) use ($controller, $method, $container) {
        // Here's the magic! The container automatically creates the controller
        // and injects all its dependencies
        $controllerInstance = $container->make($controller); // this is needed; we need to instantiate controller via DI
        return $controllerInstance->$method($request);
    });
}

// match the request
$matcher = $routerContainer->getMatcher();
$route = $matcher->match($request);

// if no route registered for current path, it can be a 404 error, or 405, 406, etc.
if (!$route) {
    // get the first of the best-available non-matched routes
    $failedRoute = $matcher->getFailedRoute();

    // we need to handle the failed route
    $response = match ($failedRoute->failedRule) {
        // if method was not allowed (e.g., received GET request on a POST route)
        'Aura\Router\Rule\Allows' => (function () {
                // 405 METHOD NOT ALLOWED
                return new HtmlResponse('405 METHOD NOT ALLOWED!!!', 405);
            })(),
        // if content type was not accepted (e.g. received HTML request on a JSON route)
        'Aura\Router\Rule\Accepts' => (function () {
                // 406 NOT ACCEPTABLE
                return new HtmlResponse('406 NOT ACCEPTABLE!!!', 406);
            })(),
        // handle as a 404 error for other cases
        default => new HtmlResponse('404 NOT FOUND!!!', 404)
    };
} else {
    // A route was found, so let's handle the "happy path"

    // add route attributes to the request
    foreach ($route->attributes as $key => $val) {
        $request = $request->withAttribute($key, $val);
    }

    // dispatch the route and get the response
    $handler = $route->handler;
    $response = $handler($request); // This executes our closure and gets the HtmlResponse object
}

// emit the response
foreach ($response->getHeaders() as $name => $values) {
    foreach ($values as $value) {
        header(sprintf('%s: %s', $name, $value), false);
    }
}
http_response_code($response->getStatusCode());
echo $response->getBody();
