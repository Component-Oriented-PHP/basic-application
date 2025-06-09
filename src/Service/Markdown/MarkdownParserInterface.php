<?php

declare(strict_types=1);

namespace App\Service\Markdown;

interface MarkdownParserInterface
{
    public function parse(string $markdown): array;
}