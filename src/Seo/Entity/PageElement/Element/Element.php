<?php

declare(strict_types=1);

namespace App\Seo\Entity\PageElement\Element;

use App\Seo\Entity\PageElement\Element\Options\AttributeMap;
use App\Seo\Entity\PageElement\Element\Options\Options;
use App\Seo\Entity\Tag\Tag;
use InvalidArgumentException;
use JetBrains\PhpStorm\Pure;

class Element
{
    private Tag $tag;
    private Options $options;

    public function __construct(Tag $tag, Options $options)
    {
        $this->tag = $tag;
        $this->options = $options;

        if ($this->tag->getType()->isSingle() && $this->options->getText()) {
            throw new InvalidArgumentException(
                'Ошибка: для элемента с одиночным тегом (пустого) не следует задавать текст'
            );
        }
    }

    public function render(): string
    {
        $html = $this->renderOpeningTag();
        if ($this->tagIsPair()) {
            $html .= "{$this->getText()}</{$this->renserClosingTag()}>";
        }
        return $html;
    }

    #[Pure]
    private function tagIsPair(): bool
    {
        return $this->tag->isPair();
    }

    #[Pure]
    private function getText(): string
    {
        return $this->options->getText();
    }

    #[Pure]
    private function getAttributeMap(): AttributeMap
    {
        return $this->options->getAttributeMap();
    }

    private function renderOpeningTag(): string
    {
        return "<{$this->tag->render()}{$this->getAttributeMap()->renderInTag()}>";
    }

    #[Pure]
    private function renserClosingTag(): string
    {
        return "{$this->getText()}</{$this->tag->render()}>";
    }
}
