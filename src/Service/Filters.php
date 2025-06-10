<?php

declare(strict_types=1);

namespace App\Service;

use App\Library\Http\CustomResponseInterface;
use Psr\Http\Message\ResponseInterface;

class Filters
{

    public function __construct(private CustomResponseInterface $response)
    {
    }

    public function runFilter(string $filter, $request): ?ResponseInterface
    {
        return match ($filter) {
            'apiauth' => $this->apiFilter($request),
            default => null,
        };
    }

    private function apiFilter($request): ?ResponseInterface
    {
        // x-api-key is set
        if (!$request->hasHeader('x-api-key')) {
            return $this->response->json([
                'success' => false,
                'message' => 'Missing API key'
            ], 401);
        }

        // x-api-key is valid
        if ($request->getHeaderLine('x-api-key') !== getenv('API_KEY')) {
            return $this->response->json([
                'success' => false,
                'message' => 'Invalid API key'
            ], 401);
        }

        return null;
    }
}