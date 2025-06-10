<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Library\Http\CustomResponseInterface;
use App\Service\PageFetcher;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class PageController
{
    public function __construct(
        private PageFetcher $pageFetcher,
        private CustomResponseInterface $response
    ) {
    }

    public function index(): ResponseInterface
    {
        // get all pages
        $pages = $this->pageFetcher->fetchAll();

        // create a response
        return $this->response->json([
            'success' => true,
            'data' => $pages
        ]);
    }

    public function show(ServerRequestInterface $request): ResponseInterface
    {
        // get the slug
        $slug = $request->getAttribute('slug');

        // get the page
        $page = $this->pageFetcher->fetchSingle($slug);

        // if empty
        if (!$page) {
            return $this->response->json([
                'success' => false,
                'message' => 'Page not found'
            ], 404);
        }

        // create a response
        return $this->response->json([
            'success' => true,
            'data' => $page
        ]);
    }
}