<?php

declare(strict_types=1);

namespace Test\Unit\Http;

use App\Http\Response\JsonResponse;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * @covers App\Http\JsonResponse
 */
class JsonResponseTets extends TestCase
{
    /**
     * @dataProvider getCases
     */
    public function testResponse(mixed $source, mixed $expect): void
    {
        $response = new JsonResponse($source);
        self::assertEquals('application/json', $response->getHeaderLine('Content-Type'));
        self::assertEquals($expect, $response->getBody()->getContents());
        self::assertEquals(200, $response->getStatusCode());
    }

    /**
     * @psalm-return iterable<array-key, array<array-key, mixed>>
     */
    public function getCases(): iterable
    {
        $object = new stdClass();
        $object->str = 'value';
        $object->int = 1;
        $object->none = null;

        $array = [
            'str' => 'value',
            'int' => 1,
            'none' => null,
        ];

        return [
            'null' => [null, 'null'],
            'empty' => ['', '""'],
            'number' => [12, '12'],
            'string' => ['12', '"12"'],
            'object' => [$object, '{"str":"value","int":1,"none":null}'],
            'array' => [$array, '{"str":"value","int":1,"none":null}'],
        ];
    }
}
