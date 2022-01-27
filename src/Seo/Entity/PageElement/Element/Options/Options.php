<?php

declare(strict_types=1);

namespace App\Seo\Entity\PageElement\Element\Options;

use JetBrains\PhpStorm\Pure;

class Options
{
    private AttributeMap $attributeMap;
    private string $text;

    /**
     * @param array{attributeMap: array<string, string>, text: string} $options $options
     */
    #[Pure]
    public function __construct(array $options)
    {
        $this->attributeMap = new AttributeMap($options['attributeMap'] ?? []);
        $this->text = $options['text'] ?? '';
    }

    public function getAttributeMap(): AttributeMap
    {
        return $this->attributeMap;
    }

    public function getText(): mixed
    {
        return $this->text;
    }
}
