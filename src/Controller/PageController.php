<?php

declare(strict_types=1);

namespace App\Controller;

use App\Library\View\RendererInterface;
use App\Service\Markdown\MarkdownParserInterface;
use App\Service\PageFetcher;
use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class PageController
{

    public function __construct(
        private PageFetcher $pageFetcher,
        private RendererInterface $view
    ) {
    }

    public function show(ServerRequestInterface $request): ResponseInterface
    {
        $slug = $request->getAttribute('slug');

        $page = $this->pageFetcher->fetchSingle($slug);

        if (!$page) {
            return new HtmlResponse($this->view->render('404'), 404);
        }

        return new HtmlResponse($this->view->render('page/show', [
            'title' => $page['title'],
            'description' => $page['description'],
            'page' => $page
        ]));
    }

}