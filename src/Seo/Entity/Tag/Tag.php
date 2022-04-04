<?php

declare(strict_types=1);

namespace App\Seo\Entity\Tag;

class Tag
{
    private string $name;
    private Type $type;

    public function __construct(string $name, Type $type)
    {
        $this->name = $name;
        $this->type = $type;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): Type
    {
        return $this->type;
    }
}
