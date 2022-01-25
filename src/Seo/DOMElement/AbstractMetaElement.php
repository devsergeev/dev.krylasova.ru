<?php

declare(strict_types=1);

namespace App\Seo\DOMElement;

use InvalidArgumentException;

class AbstractMetaElement extends AbstractElement
{
    private const TAG_NAME = 'meta';

    public function __construct(array $attributeMap)
    {
        if (!$attributeMap) {
            throw new InvalidArgumentException('Метатег должен содержать атрибуты');
        }
        parent::__construct(
            self::TAG_NAME,
            $attributeMap
        );
    }
}
