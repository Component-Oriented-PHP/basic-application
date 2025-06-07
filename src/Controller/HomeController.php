<?php

declare(strict_types=1);

namespace App\Controller;

use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ServerRequestInterface;

class HomeController
{
    public function index(ServerRequestInterface $request)
    {
        return new HtmlResponse('This tuts rocks!!! This comes from Home Controller!');
    }
}