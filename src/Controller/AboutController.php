<?php

declare(strict_types=1);

namespace App\Controller;

use App\Library\View\PlatesRenderer;
use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ServerRequestInterface;

class AboutController
{

    private PlatesRenderer $view;

    public function __construct()
    {
        $this->view = new PlatesRenderer();
    }

    public function index(ServerRequestInterface $request)
    {
        return new HtmlResponse($this->view->render('about/index', [
            'title' => 'This is a title for About Us!'
        ]));
    }
}