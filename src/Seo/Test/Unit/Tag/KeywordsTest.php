<?php

declare(strict_types=1);

namespace App\Seo\Test\Unit\Tag;

use App\Seo\DOMElement\Keywords;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class KeywordsTest extends TestCase
{
    public function testSuccess(): void
    {
        $tag = new Keywords('Ключевые слова');

        self::assertEquals('<meta name="keywords" content="Ключевые слова">', (string)$tag);
        self::assertEquals('meta', $tag->getTagName());
        self::assertEquals(
            ['name' => 'keywords', 'content' => 'Ключевые слова'],
            $tag->getAttributeMap()->getAll()
        );
    }

    public function testEmpty(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new \App\Seo\DOMElement\Keywords('');
    }
}