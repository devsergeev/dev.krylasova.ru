<?php

declare(strict_types=1);

namespace App\Seo\Entity\Template;

use App\Seo\Entity\Element\Element;

class Template
{
    private string $name;
    private Element $element;
    private Required $required;

    public function __construct(
        string $name,
        Element $element,
        Required $required
    )
    {
        $this->name = $name;
        $this->element = $element;
        $this->required = $required;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getElement(): Element
    {
        return $this->element;
    }

    public function getRequired(): Required
    {
        return $this->required;
    }
}
