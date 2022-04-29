<?php

declare(strict_types=1);

namespace App\Seo\Entity\Tag;

use Webmozart\Assert\Assert;

class Type
{
    public const SINGLE = 's';
    public const PAIR = 'p';

    private string $type;

    public function __construct(string $type)
    {
        Assert::oneOf($type, [self::SINGLE, self::PAIR]);
        $this->type = $type;
    }

    public static function single(): self
    {
        return new self(self::SINGLE);
    }

    public static function pair(): self
    {
        return new self(self::PAIR);
    }

    public function isSingle(): bool
    {
        return $this->type === self::SINGLE;
    }

    public function isPair(): bool
    {
        return $this->type === self::PAIR;
    }

    public function __toString(): string
    {
        return $this->type;
    }
}
