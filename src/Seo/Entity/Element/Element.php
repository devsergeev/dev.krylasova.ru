<?php

declare(strict_types=1);

namespace App\Seo\Entity\Element;

use App\Seo\Entity\Tag\Tag;
use InvalidArgumentException;

class Element
{
    private Tag $tag;
    private Attributes $attributes;
    private ?string $text;

    public function __construct(Tag $tag, Attributes $attributes, $text = null)
    {
        if ($tag->getType()->isSingle() && $text) {
            throw new InvalidArgumentException(
                'Ошибка: для элемента с одиночным тегом (пустого) не следует задавать текст'
            );
        }

        $this->tag = $tag;
        $this->attributes = $attributes;
        $this->text = $text;
    }

    public function getTag(): Tag
    {
        return $this->tag;
    }

    public function getAttributes(): Attributes
    {
        return $this->attributes;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function render(): string
    {
        $html = "<{$this->tag->getName()}{$this->renderAttributes()}>";
        if ($this->tag->getType()->isPair()) {
            $html .= "{$this->getText()}</{$this->tag->getName()}>";
        }
        return $html;
    }

    private function renderAttributes(): string
    {
        $string = $this->attributes->toString();
        return $string ? (' ' . $string) : '';
    }
}
