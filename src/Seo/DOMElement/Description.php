<?php

declare(strict_types=1);

namespace App\Seo\DOMElement;

use InvalidArgumentException;

class Description extends AbstractMetaElement
{
    public function __construct(string $content)
    {
        if (!(boolean)$content) {
            throw new InvalidArgumentException('Description должен быть заполнен');
        }
        parent::__construct([
            'name' => 'description',
            'content' => $content,
        ]);
    }
}
