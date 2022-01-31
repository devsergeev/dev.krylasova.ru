<?php

declare(strict_types=1);

namespace App\Seo\Entity\Tag;

use JetBrains\PhpStorm\Pure;

class Tag
{
    private string $name;
    private Type $type;

    public function __construct(string $name, Type $type)
    {
        $this->name = $name;
        $this->type = $type;
    }

    public function render(): string
    {
        return $this->name;
    }

    public function getType(): Type
    {
        return $this->type;
    }

    #[Pure]
    public function isPair(): bool
    {
        return $this->type->isPair();
    }

    #[Pure]
    public function isSingle(): bool
    {
        return $this->type->isSingle();
    }
}
