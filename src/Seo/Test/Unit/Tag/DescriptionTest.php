<?php

declare(strict_types=1);

namespace App\Seo\Test\Unit\Tag;

use App\Seo\Tag\Description;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class DescriptionTest extends TestCase
{
    public function testSuccess(): void
    {
        $tag = new Description('Описание страницы');
        self::assertEquals('<meta name="description" content="Описание страницы">', (string)$tag);
    }

    public function testEmpty(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Description('');
    }
}
