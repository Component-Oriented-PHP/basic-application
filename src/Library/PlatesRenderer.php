<?php

declare(strict_types=1);

namespace App\Library;

use League\Plates\Engine;

class PlatesRenderer
{
    private Engine $engine;

    public function __construct()
    {
        $this->engine = new Engine(__DIR__ . '/../../templates/plates');
    }

    public function render(string $template, array $data): string
    {
        return $this->engine->render($template, $data);
    }
}