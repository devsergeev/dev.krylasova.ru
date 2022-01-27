<?php

declare(strict_types=1);

namespace App\Seo\Entity\PageElement\Element\Options;

class AttributeMap
{
    private array $attributeMap;

    public function __construct(array $attributeMap)
    {
        $this->attributeMap = $attributeMap;
    }

    public function getAll(): array
    {
        return $this->attributeMap;
    }

    public function renderInTag(): string
    {
        $string = $this->toString();
        return $string ? (' ' . $string) : '';
    }

    private function toString(): string
    {
        $attributes = array_map(
            static fn ($name, $value) => "{$name}=\"{$value}\"",
            array_keys($this->attributeMap),
            $this->attributeMap
        );
        return $attributes ? implode(' ', $attributes) : '';
    }
}
