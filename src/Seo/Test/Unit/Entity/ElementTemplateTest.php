<?php

namespace App\Seo\Test\Unit\Entity;

use App\Seo\Entity\Element\Attributes;
use App\Seo\Entity\Tag\Tag;
use App\Seo\Entity\Tag\Type;
use App\Seo\Entity\Template\Required;
use App\Seo\Entity\Template\Template;
use App\Seo\Entity\ElementTemplate;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ElementTemplateTest extends TestCase
{
    public function testSuccess()
    {
        $template = new Template(
            'Метатег Description',
            new Required(['content']),
            new Tag('meta', new Type(Type::SINGLE)),
            new Attributes(['name' => 'description']),
        );

        $customAttributes = new Attributes(['content' => 'Описание главной страницы раскрыто в этом тексте']);

        $templateElement = new ElementTemplate(
            $template,
            $customAttributes
        );

        $this->assertEquals(
            '<meta name="description" content="Описание главной страницы раскрыто в этом тексте">',
            $templateElement->render()
        );
    }

    public function testRequired()
    {
        $template = new Template(
            'Метатег Description',
            new Required([], true),
            new Tag('button', new Type(Type::PAIR)),
            new Attributes([
                'disabled'
            ])
        );

        $customAttributes = new Attributes(['name' => 'sale']);

        $templateElement = new ElementTemplate(
            $template,
            $customAttributes,
        );

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Обязательно должен быть указан текст элемента');
        $templateElement->render();
    }
}
