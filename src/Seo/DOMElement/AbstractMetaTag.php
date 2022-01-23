<?php

declare(strict_types=1);

namespace App\Seo\DOMElement;

use InvalidArgumentException;

class AbstractMetaTag extends AbstractEmptyElement
{
    private const TAG_NAME = 'meta';

    public function __construct(array $attributes)
    {
        if (!$attributes) {
            throw new InvalidArgumentException('Метатег должен содержать атрибуты');
        }
        parent::__construct(self::TAG_NAME, $attributes);
    }
}
