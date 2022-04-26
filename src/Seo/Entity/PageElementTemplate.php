<?php

declare(strict_types=1);

namespace App\Seo\Entity;

use App\Seo\Entity\Tag\Tag;
use App\Seo\Entity\Template\Template;
use Doctrine\ORM\Mapping as ORM;
use InvalidArgumentException;
use JetBrains\PhpStorm\Pure;

#[ORM\Entity]
#[ORM\Table(name: 'seo_page_element_template')]
class PageElementTemplate
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Tag::class)]
    private Page $page;

    #[ORM\ManyToOne(targetEntity: Template::class)]
    private Template $template;

    #[ORM\Column(type: AttributesType::NAME)]
    private Attributes $customAttributes;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $customText;

    public function __construct(
        Page       $page,
        Template   $template,
        Attributes $customAttributes,
        string     $customText = null,
    )
    {
        if ($template->getRequired()->textIsRequired() && !$customText) {
            throw new InvalidArgumentException("Обязательно должен быть указан текст элемента");
        }

        foreach ($template->getRequired()->getAttributes() as $value) {
            if (!$customAttributes->has($value)) {
                throw new InvalidArgumentException("Атрибут `{$value}` является обязательным, но не задан");
            }
        }

        if ($template->getTag()->getType()->isSingle() && $customText) {
            throw new InvalidArgumentException(
                'Ошибка: для элемента с одиночным тегом (пустого) не следует задавать текст'
            );
        }

        $this->page = $page;
        $this->template = $template;
        $this->customAttributes = $customAttributes;
        $this->customText = $customText;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getPage(): Page
    {
        return $this->page;
    }

    public function getTemplate(): Template
    {
        return $this->template;
    }

    public function getCustomAttributes(): Attributes
    {
        return $this->customAttributes;
    }

    public function getCustomText(): ?string
    {
        return $this->customText;
    }

    public function render(): string
    {
        $html = "<{$this->template->getTag()->getName()}{$this->getAttributes()->render()}>";
        if ($this->template->getTag()->getType()->isPair()) {
            $html .= "{$this->mergeText()}</{$this->template->getTag()->getName()}>";
        }
        return $html;
    }

    #[Pure]
    private function getAttributes(): Attributes
    {
        $defaultAttributes = $this->getTemplate()->getDefaultAttributes()->getAll();
        $customAttributes = $this->getCustomAttributes()->getAll();
        return new Attributes(array_merge($defaultAttributes, $customAttributes));
    }

    #[Pure]
    private function mergeText(): ?string
    {
        if ($this->getCustomText()) {
            return $this->getCustomText();
        }
        return $this->getTemplate()->getText();
    }
}
