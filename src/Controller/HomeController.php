<?php

declare(strict_types=1);

namespace App\Controller;

use Laminas\Diactoros\Response\HtmlResponse;

class HomeController
{
    public function index()
    {
        return new HtmlResponse('This tuts rocks!!! This comes from Home Controller');
    }
}