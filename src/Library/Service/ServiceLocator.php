<?php

declare(strict_types=1);

namespace App\Library\Service;

use App\Library\View\PlatesRenderer;

class ServiceLocator
{
    private array $services = [];

    public function get(string $serviceName)
    {
        if (!isset($this->services[$serviceName])) {
            $this->services[$serviceName] = $this->createService($serviceName);
        }

        return $this->services[$serviceName];
    }

    private function createService(string $serviceName)
    {
        switch ($serviceName) {
            case 'view':
                return new PlatesRenderer();
            default:
                throw new \Exception("Service {$serviceName} not found");
        }
    }
}