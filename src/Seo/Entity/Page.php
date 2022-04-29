<?php

declare(strict_types=1);

namespace App\Seo\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'seo_page')]
class Page
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private string $code;

    public function __construct(
        string $code,
    )
    {
        $this->code = $code;
    }

    private function getId(): int
    {
        return $this->id;
    }

    private function getCode(): string
    {
        return $this->code;
    }
}
