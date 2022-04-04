<?php

namespace App\Seo\Test\Unit\Entity;

use App\Seo\Entity\Element\Attributes;
use App\Seo\Entity\Element\Element;
use App\Seo\Entity\Tag\Tag;
use App\Seo\Entity\Tag\Type;
use App\Seo\Entity\Template\Required;
use App\Seo\Entity\Template\Template;
use App\Seo\Entity\TemplateElement;
use PHPUnit\Framework\TestCase;

class TemplateElementTest extends TestCase
{
    public function testSuccess()
    {
        $tag = new Tag('meta', new Type(Type::SINGLE));
        $attributes = new Attributes(['name' => 'description']);
        $element = new Element($tag, $attributes);

        $required = new Required(['content']);

        $template = new Template('Метатег Description', $element, $required);

        $customAttributes = new Attributes(['content' => 'Описание главной страницы раскрыто в этом тексте']);
        $templateElement = new TemplateElement($template, $customAttributes);
        $element = $templateElement->toElement();

        $this->assertEquals(
            '<meta name="description" content="Описание главной страницы раскрыто в этом тексте">',
            $element->render()
        );
    }
}
