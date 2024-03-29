<?php

declare(strict_types=1);

namespace App\Seo\Entity\Template;

class Required
{
    private array $attributes;
    private bool $text;

    public function __construct(
        array $attributes,
        bool  $text = false,
    )
    {
        $this->attributes = $attributes;
        $this->text = $text;
    }

    public static function fromJson(string $jsonString): self
    {
        [$attributes, $text] = json_decode($jsonString, true);
        return new self($attributes, $text);
    }

    public function toJson(): string
    {
        return json_encode([$this->attributes, $this->text]);
    }

    public function textIsRequired(): bool
    {
        return $this->text;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }
}
