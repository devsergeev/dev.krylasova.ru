<?php

declare(strict_types=1);

namespace App\Seo\Test\Unit\Tag;

use App\Seo\Tag\Title;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class TitleTest extends TestCase
{
    public function testSuccess(): void
    {
        $tag = new Title('Заголовок страницы');

        self::assertEquals('<title>Заголовок страницы</title>', (string)$tag);
        self::assertEquals('title', $tag->getTagName());
        self::assertEquals(
            [],
            $tag->getAttributeList()->getAttributeMap()
        );
    }

    public function testEmpty(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Title('');
    }
}
