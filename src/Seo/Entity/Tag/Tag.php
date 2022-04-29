<?php

declare(strict_types=1);

namespace App\Seo\Entity\Tag;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'seo_tag')]
class Tag
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\Column(type: 'string', length: 16, unique: true)]
    private string $name;

    #[ORM\Column(type: TypeType::NAME)]
    private Type $type;

    public function __construct(
        string $name,
        Type   $type,
    )
    {
        $this->name = $name;
        $this->type = $type;
    }

    private function getId(): int
    {
        return $this->id;
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
