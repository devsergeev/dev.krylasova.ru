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
    protected AttributeList $attributeList;

    #[Pure]
    public function __construct(string $tagName, array $attributeMap = [])
    {
        $this->tagName = $tagName;
        $this->attributeList = new AttributeList($attributeMap);
    }

    public function __toString(): string
    {
        return "<{$this->tagName}{$this->attributeList}>";
    }

    public function getTagName(): string
    {
        return $this->tagName;
    }

    public function getAttributeList(): AttributeList
    {
        return $this->attributeList;
    }
}
