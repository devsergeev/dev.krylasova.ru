<?php

declare(strict_types=1);

namespace App\Seo\Test\Unit\Tag;

use App\Seo\DOMElement\Title;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class TitleTest extends TestCase
{
    public function testSuccess(): void
    {
        $tag = new \App\Seo\DOMElement\Title('Заголовок страницы');

        self::assertEquals('<title>Заголовок страницы</title>', (string)$tag);
        self::assertEquals('title', $tag->getTagName());
        self::assertEquals(
            [],
            $tag->getAttributeMap()->getAll()
        );
    }

    public function testEmpty(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new \App\Seo\DOMElement\Title('');
    }
}
