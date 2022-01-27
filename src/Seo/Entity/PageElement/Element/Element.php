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
        $html = "<{$this->tag->render()}{$this->getAttributeMap()->renderInTag()}>";
        if ($this->tag->isPair()) {
            $html .= "{$this->getText()}</{$this->tag->render()}>";
        }
        return $html;
    }

    #[Pure]
    public function getText(): string
    {
        return $this->options->getText();
    }

    #[Pure]
    public function getAttributeMap(): AttributeMap
    {
        return $this->options->getAttributeMap();
    }
}
