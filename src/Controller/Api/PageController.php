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

    public function index(ServerRequestInterface $request): ResponseInterface
    {
        // Authenticate the endpoint. If it returns a response, return it immediately.
        if ($authResponse = $this->authenticate($request, $this->response)) {
            return $authResponse;
        }

        // This code will only run if authentication was successful
        $pages = $this->pageFetcher->fetchAll();

        // create a response
        return $this->response->json([
            'success' => true,
            'data' => $pages
        ]);
    }

    public function show(ServerRequestInterface $request): ResponseInterface
    {
        // Authenticate the endpoint. If it returns a response, return it immediately.
        if ($authResponse = $this->authenticate($request, $this->response)) {
            return $authResponse;
        }

        // This code will only run if authentication was successful
        $slug = $request->getAttribute('slug');
        $page = $this->pageFetcher->fetchSingle($slug);

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

    private function authenticate(ServerRequestInterface $request, CustomResponseInterface $response)
    {

        // x-api-key is set
        if (!$request->hasHeader('x-api-key')) {
            return $response->json([
                'success' => false,
                'message' => 'Missing API key'
            ], 401);
        }

        // x-api-key is valid
        if ($request->getHeaderLine('x-api-key') !== '1234567890') {
            return $response->json([
                'success' => false,
                'message' => 'Invalid API key'
            ], 401);
        }

        return null;
    }
}