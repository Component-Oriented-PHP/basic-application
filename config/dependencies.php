<?php

use App\Library\Config\ConfigInterface;
use App\Library\Config\PHPConfigFetcher;
use App\Library\View\RendererInterface;
use App\Library\View\TwigRenderer;

return [
    RendererInterface::class => TwigRenderer::class,
    // or RendererInterface::class => \App\Library\View\PlatesRenderer::class

    ConfigInterface::class => PHPConfigFetcher::class
];