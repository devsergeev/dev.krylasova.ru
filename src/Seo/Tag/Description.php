<?php

declare(strict_types=1);

namespace App\Seo\Tag;

use App\Seo\DOMElement\AbstractMetaTag;
use InvalidArgumentException;

class Description extends AbstractMetaTag
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
