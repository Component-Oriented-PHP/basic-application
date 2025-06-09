<?php

declare(strict_types=1);

namespace App\Service;

use App\Library\Config\ConfigInterface;
use App\Service\Markdown\MarkdownParserInterface;

class PageFetcher
{

    private string $markdownPath;

    public function __construct(
        private ConfigInterface $config,
        private MarkdownParserInterface $markdown
    ) {
        $this->markdownPath = $config->get('markdown.content_dir');
    }

    public function fetchAll(): array
    {
        $files = glob($this->markdownPath . '/*.md');

        $data = [];
        foreach ($files as $file) {
            $slug = basename($file, '.md');
            $page = $this->markdown->parse(file_get_contents($file));
            $data[] = [
                'title' => $page['title'],
                'description' => $page['description'],
                'slug' => $slug
            ];
        }

        return $data;
    }

    public function fetchSingle(string $pageName): array
    {
        $path = $this->markdownPath . '/' . $pageName . '.md';

        if (!file_exists($path)) {
            return [];
        }

        return $this->markdown->parse(file_get_contents($path));
    }

}