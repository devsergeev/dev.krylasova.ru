<?php

declare(strict_types=1);

namespace App\Seo\DOMElement;

class AttributeList
{
    private array $attributeMap;

    public function __construct(array $attributeMap)
    {
        $this->attributeMap = $attributeMap;
    }

    public function __toString(): string
    {
        $attributes = array_map(
            static fn ($name, $value) => "{$name}=\"{$value}\"",
            array_keys($this->attributeMap),
            $this->attributeMap
        );
        return $attributes ? (' ' . implode(' ', $attributes)) : '';
    }
}
