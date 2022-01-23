<?php

declare(strict_types=1);

namespace App\Seo\Tag;

use App\Seo\DOMElement\AbstractMetaTag;
use InvalidArgumentException;

class Keywords extends AbstractMetaTag
{
    public function __construct(string $content)
    {
        if (!$content) {
            throw new InvalidArgumentException('Keywords должен быть заполнен');
        }
        parent::__construct([
            'name' => 'keywords',
            'content' => $content,
        ]);
    }
}
