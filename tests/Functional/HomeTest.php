<?php

declare(strict_types=1);

namespace Test\Functional;

class HomeTest extends WebTestCase
{
    public function testBadMethod(): void
    {
        $response = $this->app()->handle(self::json('POST', '/'));
        self::assertEquals(405, $response->getStatusCode());
    }

    public function testSuccess(): void
    {
        $response = $this->app()->handle(self::json('GET', '/'));
        self::assertEquals(200, $response->getStatusCode());
        self::assertEquals('text/html', $response->getHeaderLine('Content-Type'));
    }
}
