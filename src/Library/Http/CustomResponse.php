<?php

declare(strict_types=1);

namespace App\Library\Http;

use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Diactoros\Response\RedirectResponse;
use Laminas\Diactoros\Response\XmlResponse;
use Psr\Http\Message\ResponseInterface;

class CustomResponse implements CustomResponseInterface
{

    public function html(string $html, int $status = 200, array $headers = []): ResponseInterface
    {
        return new HtmlResponse($html, $status, $headers);
    }

    public function json(array $data, int $status = 200, array $headers = []): ResponseInterface
    {
        return new JsonResponse($data, $status, $headers);
    }

    public function redirect(string $url, int $status = 302, array $headers = []): ResponseInterface
    {
        return new RedirectResponse($url, $status, $headers);
    }

    public function xml(string $xml, int $status = 200, array $headers = []): ResponseInterface
    {
        return new XmlResponse($xml, $status, $headers);
    }

}