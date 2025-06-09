<?php

declare(strict_types=1);

namespace App\Service;

use App\Library\Config\ConfigInterface;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\FrontMatter\FrontMatterExtension;
use League\CommonMark\Extension\FrontMatter\Output\RenderedContentWithFrontMatter;
use League\CommonMark\MarkdownConverter;

class MarkdownParser
{
    private MarkdownConverter $markdownConverter;

    public function __construct(
        private ConfigInterface $configInterface
    ) {
        $config = $this->configInterface->get('markdown');
        $environment = new Environment($config['config']);
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addExtension(new FrontMatterExtension());
        foreach ($config['extensions'] as $extension) {
            $environment->addExtension(new $extension());
        }
        $this->markdownConverter = new MarkdownConverter($environment);
    }

    public function parse(string $markdown): array
    {
        $output = $this->markdownConverter->convert($markdown);
        $data = [];

        if ($output instanceof RenderedContentWithFrontMatter) {
            $frontMatter = $output->getFrontMatter();
            $content = (string) $output->getContent();

            // Add front matter data to result
            foreach ($frontMatter as $key => $value) {
                $data[$key] = $value;
            }
        } else {
            // Handle regular markdown without front matter
            $content = (string) $output;
        }

        $data['content'] = $content;

        return $data;
    }
}