<?php

declare(strict_types=1);

namespace App\Controller;

use App\Library\View\RendererInterface;
use App\Service\Markdown\MarkdownParserInterface;
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

        $page = []; // TODO: logic to get page
    }

}