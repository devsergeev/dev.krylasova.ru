<?php

declare(strict_types=1);

namespace Test\Functional;

use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;
use Slim\Psr7\Factory\ServerRequestFactory;

class WebTestCase extends TestCase
{
    protected static function json(string $method, string $url): ServerRequestInterface
    {
        return self::request($method, $url)
            ->withHeader('Accept', 'application/json')
            ->withHeader('Content-Type', 'application/json');
    }

    protected static function request(string $method, string $url): ServerRequestInterface
    {
        return (new ServerRequestFactory())->createServerRequest($method, $url);
    }

    protected function app(): App
    {
        return (require __DIR__ . '/../../config/app.php')($this->container());
    }

    private function container(): ContainerInterface
    {
        return require __DIR__ . '/../../config/container.php';
    }
}
