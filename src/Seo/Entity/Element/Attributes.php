<?php

declare(strict_types=1);

namespace App\Seo\Entity\Element;

class Attributes
{
    private array $attributes;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    public function getAll(): array
    {
        return $this->attributes;
    }

    public function has(string $key): bool
    {
        return isset($this->attributes[$key]);
    }

    public function toString(): string
    {
        $attributes = array_map(
            static fn ($name, $value) => is_numeric($name) ? "{$value}" : "{$name}=\"{$value}\"",
            array_keys($this->attributes),
            $this->attributes
        );
        return $attributes ? implode(' ', $attributes) : '';
    }
}
