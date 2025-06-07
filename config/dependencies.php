<?php

use App\Library\View\RendererInterface;
use App\Library\View\TwigRenderer;

return [
    RendererInterface::class => TwigRenderer::class,
    // or RendererInterface::class => \App\Library\View\PlatesRenderer::class
];