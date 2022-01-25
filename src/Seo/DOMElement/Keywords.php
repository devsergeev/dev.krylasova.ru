<?php

declare(strict_types=1);

namespace App\Seo\DOMElement;

use InvalidArgumentException;

class Keywords extends AbstractMetaElement
{
    public function __construct(string $content)
    {
        if (!(boolean)$content) {
            throw new InvalidArgumentException('Keywords должен быть заполнен');
        }
        parent::__construct([
            'name' => 'keywords',
            'content' => $content,
        ]);
    }
}
