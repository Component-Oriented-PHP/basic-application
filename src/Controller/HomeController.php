<?php

declare(strict_types=1);

namespace App\Controller;

use App\Library\View\RendererInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ServerRequestInterface;

class HomeController
{
    public function __construct(private RendererInterface $view)
    {
    }

    public function index(ServerRequestInterface $request)
    {
        var_dump((new \App\Service\MarkdownParser())->parse(file_get_contents(__DIR__ . '/../../content/about.md')));die;
        return new HtmlResponse($this->view->render('home/index', [
            'title' => 'This is a title for Homepage!',
        ]));
    }
}