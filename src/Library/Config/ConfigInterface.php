<?php

declare(strict_types=1);

namespace App\Library\Config;

interface ConfigInterface
{
    public function get(string $key): mixed;
}