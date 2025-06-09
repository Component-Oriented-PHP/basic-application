<?php

declare(strict_types=1);

namespace App\Library\Http;

use Psr\Http\Message\ResponseInterface;

interface CustomResponseInterface 
{

    public function html(string $html, int $status = 200, array $headers = []): ResponseInterface;

    public function json(array $data, int $status = 200, array $headers = []): ResponseInterface;

    public function redirect(string $url, int $status = 302, array $headers = []): ResponseInterface;

    public function xml(string $xml, int $status = 200, array $headers = []): ResponseInterface;

}