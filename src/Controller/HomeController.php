<?php

declare(strict_types=1);

namespace App\Controller;

use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ServerRequestInterface;

class HomeController
{
    public function __construct(private ServerRequestInterface $request)
    {
    }

    public function index()
    {
        return new HtmlResponse('This tuts rocks!!! This comes from Home Controller');
    }
}