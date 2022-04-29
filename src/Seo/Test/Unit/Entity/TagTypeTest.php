<?php

namespace App\Seo\Test\Unit\Entity;

use App\Seo\Entity\Tag\Type;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class TagTypeTest extends TestCase
{
    public function testSuccess(): void
    {
        $type = new Type($code = Type::SINGLE);
        self::assertEquals($code, (string)$type);
    }

    public function testIncorrect(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Type('none');
    }

    public function testWait(): void
    {
        $type = Type::single();
        self::assertTrue($type->isSingle());
        self::assertFalse($type->isPair());
    }

    public function testActive(): void
    {
        $type = Type::pair();
        self::assertFalse($type->isSingle());
        self::assertTrue($type->isPair());
    }
}
