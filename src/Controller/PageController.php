<?php

declare(strict_types=1);

namespace App\Controller;

use App\Library\View\RendererInterface;
use App\Service\PageFetcher;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamFactoryInterface;

class PageController
{

    public function __construct(
        private PageFetcher $pageFetcher,
        private RendererInterface $view,
        private ResponseFactoryInterface $responseFactory,
        private StreamFactoryInterface $streamFactory
    ) {
    }

    public function show(ServerRequestInterface $request): ResponseInterface
    {
        $slug = $request->getAttribute('slug');

        $page = $this->pageFetcher->fetchSingle($slug);

        if (!$page) {
            $html = $this->view->render('404');
            $stream = $this->streamFactory->createStream($html);

            return $this->responseFactory->createResponse(404)->withBody($stream);
        }

        // separated for clarity and readability
        $html = $this->view->render('page/show', [
            'title' => $page['title'],
            'description' => $page['description'],
            'page' => $page
        ]);

        $stream = $this->streamFactory->createStream($html);

        return $this->responseFactory->createResponse(200)->withBody($stream);
    }

}