<?php

declare(strict_types=1);

$uri = $_SERVER['REQUEST_URI'];

echo match ($uri) {
    '/' => 'This tuts rocks!!',
    '/about' => 'This is the about page!',
    '/contact' => 'This is the contact page!',
    default => '404',
};