<?php

return [
    // route name => [route method, route path, controller::method]
    'home' => ['get', '/', '\App\Controller\HomeController::index'],
    // 'about' => ['get', '/about', '\App\Controller\AboutController::index'],
    'page' => ['get', '/{slug}', '\App\Controller\PageController::show'],

    'api.page' => ['get', '/api/page', '\App\Controller\Api\PageController::index'],
    'api.page.show' => ['get', '/api/page/{slug}', '\App\Controller\Api\PageController::show'],
];