<?php

declare(strict_types=1);

namespace App\Seo\Entity\Template;

use App\Seo\Entity\Attributes;
use App\Seo\Entity\AttributesType;
use App\Seo\Entity\Tag\Tag;
use Doctrine\ORM\Mapping as ORM;
use InvalidArgumentException;

#[ORM\Entity]
#[ORM\Table(name: 'seo_template')]
class Template
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: RequiredType::NAME)]
    private Required $required;

    #[ORM\ManyToOne(targetEntity: Tag::class)]
    private Tag $tag;

    #[ORM\Column(type: AttributesType::NAME)]
    private Attributes $defaultAttributes;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $text;

    public function __construct(
        string     $name,
        Tag        $tag,
        Required   $required,
        Attributes $defaultAttributes,
        ?string    $text = null,
    )
    {
        if ($tag->getType()->isSingle() && $text) {
            throw new InvalidArgumentException(
                'Ошибка: для элемента с одиночным тегом (пустого) не следует задавать текст'
            );
        }

        $this->name = $name;
        $this->tag = $tag;
        $this->required = $required;
        $this->defaultAttributes = $defaultAttributes;
        $this->text = $text;
    }

    private function getId(): int
    {
        return $this->id;
    }

    private function getName(): string
    {
        return $this->name;
    }

    public function getRequired(): Required
    {
        return $this->required;
    }

    public function getTag(): Tag
    {
        return $this->tag;
    }

    public function getDefaultAttributes(): Attributes
    {
        return $this->defaultAttributes;
    }

    public function getText(): ?string
    {
        return $this->text;
    }
}
