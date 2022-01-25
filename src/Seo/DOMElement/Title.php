<?php

declare(strict_types=1);

namespace App\Seo\DOMElement;

use InvalidArgumentException;

class Title extends AbstractElement
{
    private const TAG_NAME = 'title';

    public function __construct(string $text)
    {
        if (!(boolean)$text) {
            throw new InvalidArgumentException('Title должен быть заполнен');
        }
        parent::__construct(
            self::TAG_NAME,
            $text
        );
    }
}
