<?php

declare(strict_types=1);

namespace App\Library\View;

use League\Plates\Engine;

class PlatesRenderer implements RendererInterface
{
    private Engine $engine;

    public function __construct()
    {
        $this->engine = new Engine(__DIR__ . '/../../../templates/plates');
    }

    public function render(string $template, array $data = []): string
    {
        return $this->engine->render($template, $data);
    }
}