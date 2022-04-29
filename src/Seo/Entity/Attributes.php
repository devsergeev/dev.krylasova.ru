<?php

declare(strict_types=1);

namespace App\Seo\Entity;

class Attributes
{
    private array $attributes;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    public static function fromJson(string $jsonString): self
    {
        return new self(json_decode($jsonString, true));
    }

    public function toArray(): array
    {
        return $this->attributes;
    }

    public function toJson(): string
    {
        return json_encode($this->toArray());
    }

    public function hasAttribute(string $key): bool
    {
        return isset($this->attributes[$key]);
    }

    public function render(): string
    {
        $string = $this->renderAttributes();
        return $string ? (' ' . $string) : '';
    }

    private function renderAttributes(): string
    {
        $pairsKeyValue = array_map(
            static fn($name, $value) => is_numeric($name) ? "{$value}" : "{$name}=\"{$value}\"",
            array_keys($this->attributes),
            $this->attributes
        );
        return $pairsKeyValue ? implode(' ', $pairsKeyValue) : '';
    }
}
