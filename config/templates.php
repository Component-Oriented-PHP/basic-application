<?php

return [
    'twig' => [
        'path' => __DIR__ . '/../templates/twig',
        'cache_path' => __DIR__ . '/../tmp/cache',
        'debug' => getenv('APP_ENV') === 'development' ? true : false
    ],
    'plates' => [
        'path' => __DIR__ . '/../templates/plates',
    ],
];