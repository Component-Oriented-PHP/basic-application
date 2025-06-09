<?php

use App\Library\Config\ConfigInterface;
use App\Library\Config\PHPConfigFetcher;
use App\Library\Http\CustomResponse;
use App\Library\Http\CustomResponseInterface;
use App\Library\View\RendererInterface;
use App\Library\View\TwigRenderer;
use App\Service\Markdown\LeagueMarkdownParser;
use App\Service\Markdown\MarkdownParserInterface;
use App\Service\PageFetcher;
use Laminas\Diactoros\ResponseFactory;
use Laminas\Diactoros\StreamFactory;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

return [
    RendererInterface::class => TwigRenderer::class,
        // or RendererInterface::class => \App\Library\View\PlatesRenderer::class

    ConfigInterface::class => PHPConfigFetcher::class,

    MarkdownParserInterface::class => LeagueMarkdownParser::class,

    PageFetcher::class => PageFetcher::class,

    CustomResponseInterface::class => CustomResponse::class,

    ResponseFactoryInterface::class => ResponseFactory::class,
    StreamFactoryInterface::class => StreamFactory::class,
];