<?php

declare(strict_types=1);

namespace App\Seo\Entity;

use App\Seo\Entity\Element\Attributes;
use App\Seo\Entity\Element\Element;
use App\Seo\Entity\Template\Template;
use InvalidArgumentException;
use JetBrains\PhpStorm\Pure;

class TemplateElement
{
    private Template $template;
    private Attributes $attributes;
    private ?string $text;

    public function __construct(Template $template, Attributes $attributes, string $text = null)
    {
        $this->template = $template;
        $this->attributes = $attributes;
        $this->text = $text;
    }

    public function getTemplate(): Template
    {
        return $this->template;
    }

    public function getAttributes(): Attributes
    {
        return $this->attributes;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function toElement(): Element
    {
        if ($this->getTemplate()->getRequired()->textIsRequired() && !$this->getText()) {
            throw new InvalidArgumentException("Обязательно должен быть указан текст элемента");
        }

        foreach ($this->getTemplate()->getRequired()->getAttributes() as $value) {
            if (!$this->getAttributes()->has($value)) {
                throw new InvalidArgumentException("Атрибут `{$value}` является обязательным, но не задан");
            }
        }

        return new Element(
            $this->getTemplate()->getElement()->getTag(),
            $this->mergeAttributes(),
            $this->mergeText()
        );
    }

    #[Pure]
    private function mergeAttributes(): Attributes
    {
        $defaultAttributes = $this->getTemplate()->getElement()->getAttributes()->getAll();
        $customAttributes = $this->getAttributes()->getAll();
        return new Attributes(array_merge($defaultAttributes, $customAttributes));
    }

    #[Pure]
    private function mergeText(): ?string
    {
        if ($this->getText()) {
            return $this->getText();
        }
        return $this->getTemplate()->getElement()->getText();
    }
}
