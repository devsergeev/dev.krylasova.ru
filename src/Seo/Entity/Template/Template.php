<?php

declare(strict_types=1);

namespace App\Seo\Entity\Template;

use App\Seo\Entity\Element\Attributes;
use App\Seo\Entity\Tag\Tag;

class Template
{
    private string $name;
    private Required $required;
    private Tag $tag;
    private Attributes $attributes;
    private ?string $text;

    public function __construct(
        string $name,
        Required $required,
        Tag $tag,
        Attributes $attributes,
        ?string $text = null,
    )
    {
        $this->name = $name;
        $this->required = $required;
        $this->tag = $tag;
        $this->attributes = $attributes;
        $this->text = $text;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getRequired(): Required
    {
        return $this->required;
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
}
