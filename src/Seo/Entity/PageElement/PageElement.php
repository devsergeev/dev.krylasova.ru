<?php

declare(strict_types=1);

namespace App\Seo\Entity\PageElement;

use App\Seo\Entity\ElementFactory;
use App\Seo\Entity\ElementTemplate;
use App\Seo\Entity\Page;
use App\Seo\Entity\PageElement\Element\Element;
use App\Seo\Entity\PageElement\Element\Options\Options;

class PageElement
{
    private Page $page;
    private ElementTemplate $template;
    private Options $customOptions;

    private Element $element;

    public function __construct(Page $page, ElementTemplate $template, Options $customOptions)
    {
        $this->page = $page;
        $this->template = $template;
        $this->customOptions = $customOptions;
        $this->element = ElementFactory::createFromTemplate($template, $customOptions);
    }

    public function render(): string
    {
        return $this->element->render();
    }
}
