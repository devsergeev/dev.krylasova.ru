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

    public function getAll(): array
    {
        return $this->attributes;
    }

    public function has(string $key): bool
    {
        return isset($this->attributes[$key]);
    }

    public function render(): string
    {
        $string = $this->renderPairsKeyValue();
        return $string ? (' ' . $string) : '';
    }

    private function renderPairsKeyValue(): string
    {
        $pairsKeyValue = array_map(
            static fn($name, $value) => is_numeric($name) ? "{$value}" : "{$name}=\"{$value}\"",
            array_keys($this->attributes),
            $this->attributes
        );
        return $pairsKeyValue ? implode(' ', $pairsKeyValue) : '';
    }

    public function toJson(): string
    {
        return json_encode($this->attributes);
    }

    public static function fromJson(string $jsonString): self
    {
        return new self(json_decode($jsonString));
    }
}
