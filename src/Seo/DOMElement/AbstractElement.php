<?php

declare(strict_types=1);

namespace App\Seo\DOMElement;

use JetBrains\PhpStorm\Pure;

/**
 * Элементы и тэги это не одни и те же вещи. Тэги открывают или закрывают элементы в исходном коде,
 * тогда как элементы являются частью DOM, объектной моделью документа для отображения страницы в браузере.
 * @see https://developer.mozilla.org/ru/docs/Glossary/Element
 *
 * Пустой элемент — элемент HTML, который не может иметь дочерних узлов или текста внутри себя
 * @see https://developer.mozilla.org/ru/docs/Glossary/Empty_element
 */
abstract class AbstractElement
{
    private string $tagName;
    private AttributeMap $attributeMap;
    private string $text;

    #[Pure]
    public function __construct(string $tagName, array $attributeMap = [], string $text = '')
    {
        $this->tagName = $tagName;
        $this->attributeMap = new AttributeMap($attributeMap);
        $this->text = $text;
    }

    public function __toString(): string
    {
        $html = "<{$this->tagName}{$this->attributeMap}>";
        if ($this->text) {
            $html .= "{$this->text}</{$this->tagName}>";
        }
        return $html;
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
