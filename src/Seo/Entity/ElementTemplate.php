<?php

declare(strict_types=1);

namespace App\Seo\Entity;

use App\Seo\Entity\PageElement\Element\Options\Options;
use App\Seo\Entity\Tag\Tag;

class ElementTemplate
{
    private Tag $tag;

    /**
     * Предустановленные опции
     */
    private Options $defaultOptions;

    /**
     * Опции, обязательные для заполнени.
     */
    private Options $requireOptions;

    public function __construct(Tag $tag, Options $defaultOptions, Options $requireOptions)
    {
        $this->tag = $tag;
        $this->defaultOptions = $defaultOptions;
        $this->requireOptions = $requireOptions;
    }

    public function getTag(): Tag
    {
        return $this->tag;
    }

    public function getDefaultOptions(): Options
    {
        return $this->defaultOptions;
    }

    public function getRequireOptions(): Options
    {
        return $this->requireOptions;
    }
}
