<?php

declare(strict_types=1);

namespace App\Seo\Test\Unit\Entity;

use PHPUnit\Framework\TestCase;

class PageTag extends TestCase
{
    public function testSuccess(): void
    {
        self::assertEquals('test', 'main');
    }
}
