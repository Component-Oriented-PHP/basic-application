<?php

declare(strict_types=1);

namespace App\Controller;

use App\Library\View\RendererInterface;
use App\Service\Markdown\MarkdownParserInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class PageController
{

    public function __construct(
        private MarkdownParserInterface $markdown,
        private RendererInterface $view
    ) {
    }

    public function show(ServerRequestInterface $request): ResponseInterface
    {
        $slug = $request->getAttribute('slug');
        $markdownFile = __DIR__ . '/../../content/' . $slug . '.md';

        if (!file_exists($markdownFile)) {
            return new HtmlResponse($this->view->render('404'));
        }

        $page = $this->markdown->parse(file_get_contents($markdownFile));

        return new HtmlResponse($this->view->render('page/show', [
            'title' => $page['title'],
            'description' => $page['description'],
            'page' => $page
        ]));
    }

}