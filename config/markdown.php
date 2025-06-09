<?php

use League\CommonMark\Extension\Attributes\AttributesExtension;
use League\CommonMark\Extension\Autolink\AutolinkExtension;
use League\CommonMark\Extension\DisallowedRawHtml\DisallowedRawHtmlExtension;

return [
    'config' => [
        'attributes' => [
            'allow' => ['id', 'class', 'align'],
        ],
        'autolink' => [
            'allowed_protocols' => ['https'],
            'default_protocol' => 'https',
        ],
        'disallowed_raw_html' => [
            'disallowed_tags' => ['title', 'textarea', 'style', 'xmp', 'iframe', 'noembed', 'noframes', 'script', 'plaintext'],
        ],
    ],
    'extensions' => [
        AttributesExtension::class,
        AutolinkExtension::class,
        DisallowedRawHtmlExtension::class,
    ]
];