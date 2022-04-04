<?php

declare(strict_types=1);

namespace App\Seo\Entity;

use App\Seo\Entity\Element\Element;

class PageElement
{
    private Page $page;
    private Element $element;

    public function __construct(Page $page, Element $element)
    {
        $this->page = $page;
        $this->element = $element;
    }

    public function render(): string
    {
        return $this->element->render();
    }
}
