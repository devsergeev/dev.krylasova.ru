<?php

declare(strict_types=1);

namespace App\Seo\Entity;

use App\Seo\Entity\PageElement\Element\Element;
use App\Seo\Entity\PageElement\Element\Options\Options;
use InvalidArgumentException;
use JetBrains\PhpStorm\Pure;

class ElementFactory
{
    public static function createFromTemplate(ElementTemplate $template, Options $customOptions): Element
    {
        self::valid($template, $customOptions);
        $options = self::mergeOptions($template, $customOptions);
        return new Element($template->getTag(), $options);
    }

    private static function valid(ElementTemplate $template, Options $customOptions)
    {
        if ($template->getRequireOptions()->getText() && !$customOptions->getText()) {
            throw new InvalidArgumentException("Опция `text` является обязательной для заполнения");
        }

        foreach ($template->getRequireOptions()->getAttributeMap()->getAll() as $key => $value) {
            if (!$customOptions->getAttributeMap()->has($key)) {
                throw new InvalidArgumentException("Атрибут `{$key}` является обязательным обязателеным");
            }
        }
    }

    #[Pure]
    private static function mergeOptions(ElementTemplate $template, Options $customOptions): Options
    {
        $defaultText = $template->getDefaultOptions()->getText();
        $customText = $customOptions->getText();


        $defaultAttributes = $template->getDefaultOptions()->getAttributeMap()->getAll();
        $customAttributes = $customOptions->getAttributeMap()->getAll();

        return new Options([
            'attributeMap' => array_merge($defaultAttributes, $customAttributes),
            'text' => $customText ?? $defaultText
        ]);
    }
}
