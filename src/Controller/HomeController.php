<?php

declare(strict_types=1);

namespace App\Controller;

use App\Library\View\RendererInterface;
use App\Service\Markdown\MarkdownParserInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ServerRequestInterface;

class HomeController
{
    public function __construct(
        private MarkdownParserInterface $markdown,
        private RendererInterface $view
    ) {
    }

    public function index(ServerRequestInterface $request)
    {

        $pages = glob(__DIR__ . '/../../content/*.md');

        $data = [];
        foreach ($pages as $page) {
            $slug = basename($page, '.md');
            $page = $this->markdown->parse(file_get_contents($page));
            $data[] = [
                'title' => $page['title'],
                'description' => $page['description'],
                'slug' => $slug
            ];
        }

        return new HtmlResponse($this->view->render('home/index', [
            'title' => 'This is a title for Homepage!',
            'pages' => $data
        ]));
    }
}