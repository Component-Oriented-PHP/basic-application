<?php

return [
    // route name => [route method, route path, controller::method]
    'home' => ['get', '/', '\App\Controller\HomeController::index'],
    // 'about' => ['get', '/about', '\App\Controller\AboutController::index'],
    'page' => ['get', '/{slug}', '\App\Controller\PageController::show'],
];