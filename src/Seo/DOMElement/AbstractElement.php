<?php

declare(strict_types=1);

namespace App\Seo\DOMElement;

use JetBrains\PhpStorm\Pure;

/**
 * Элементы и тэги это не одни и те же вещи. Тэги открывают или закрывают элементы в исходном коде,
 * тогда как элементы являются частью DOM, объектной моделью документа для отображения страницы в браузере.
 *
 * @see https://developer.mozilla.org/ru/docs/Glossary/Element
 */
abstract class AbstractElement extends AbstractEmptyElement
{
    private string $text;

    #[Pure]
    public function __construct(string $name, string $text, array $attributes = [])
    {
        parent::__construct($name, $attributes);
        $this->text = $text;
    }

    public function __toString(): string
    {
        return parent::__toString() . "$this->text</$this->tagName>";
    }
}
