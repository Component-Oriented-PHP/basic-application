<?php

declare(strict_types=1);

namespace App\Library\View;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigRenderer implements RendererInterface
{
    private Environment $renderer;

    public function __construct()
    {
        $loader = new FilesystemLoader(__DIR__ . '/../../../templates/twig');
        $this->renderer = new Environment($loader, [
            'debug' => true,
            'cache' => __DIR__  . '/../../../tmp/cache', // set to a proper path in production
        ]);
    }

    public function render(string $template, array $data = []): string
    {
        return $this->renderer->render($template . '.twig', $data);
    }
}