<?php

declare(strict_types=1);

namespace App\Library\View;

use App\Library\Config\ConfigInterface;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigRenderer implements RendererInterface
{
    private Environment $renderer;

    public function __construct(private ConfigInterface $config)
    {
        $loader = new FilesystemLoader($this->config->get('templates.twig.path'));
        $this->renderer = new Environment($loader, [
            'debug' => $this->config->get('templates.twig.debug'),
            'cache' => $this->config->get('templates.twig.cache_path'),
        ]);
    }

    public function render(string $template, array $data = []): string
    {
        return $this->renderer->render($template . '.twig', $data);
    }
}