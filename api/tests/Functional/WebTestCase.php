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
    protected static function json(string $method, string $path, array $body = []): ServerRequestInterface
    {
        $request = self::request($method, $path)
            ->withHeader('Accept', 'application/json')
            ->withHeader('Content-Type', 'application/json');
        $request->getBody()->write(json_encode($body, JSON_THROW_ON_ERROR));
        return $request;
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
