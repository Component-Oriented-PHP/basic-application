<?php

use App\Library\Config\ConfigInterface;
use App\Library\Config\PHPConfigFetcher;
use App\Library\View\RendererInterface;
use App\Library\View\TwigRenderer;
use App\Service\Markdown\LeagueMarkdownParser;
use App\Service\Markdown\MarkdownParserInterface;

return [
    RendererInterface::class => TwigRenderer::class,
    // or RendererInterface::class => \App\Library\View\PlatesRenderer::class

    ConfigInterface::class => PHPConfigFetcher::class,

    MarkdownParserInterface::class => LeagueMarkdownParser::class
];