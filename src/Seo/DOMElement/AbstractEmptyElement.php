<?php

declare(strict_types=1);

namespace App\Seo\DOMElement;

use JetBrains\PhpStorm\Pure;

/**
 * Пустой элемент — элемент HTML, который не может иметь дочерних узлов или текста внутри себя
 *
 * @see https://developer.mozilla.org/ru/docs/Glossary/Empty_element
 */
abstract class AbstractEmptyElement
{
    protected string $tagName;
    protected AttributeMap $attributeMap;

    #[Pure]
    public function __construct(string $tagName, array $attributeMap = [])
    {
        $this->tagName = $tagName;
        $this->attributeMap = new AttributeMap($attributeMap);
    }

    public function __toString(): string
    {
        return "<{$this->tagName}{$this->attributeMap}>";
    }

    public function getTagName(): string
    {
        return $this->tagName;
    }

    public function getAttributeMap(): AttributeMap
    {
        return $this->attributeMap;
    }
}
