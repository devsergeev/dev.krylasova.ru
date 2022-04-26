<?php

namespace App\Seo\Test\Unit\Entity;

use App\Seo\Entity\Attributes;
use App\Seo\Entity\Page;
use App\Seo\Entity\PageElementTemplate;
use App\Seo\Entity\Tag\Tag;
use App\Seo\Entity\Tag\Type;
use App\Seo\Entity\Template\Required;
use App\Seo\Entity\Template\Template;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ElementTemplateTest extends TestCase
{
    public function testSuccess()
    {
        $template = new Template(
            'Метатег Description',
            new Tag('meta', new Type(Type::SINGLE)),
            new Required(['content']),
            new Attributes(['name' => 'description']),
        );

        $customAttributes = new Attributes(['content' => 'Описание главной страницы раскрыто в этом тексте']);

        $page = new Page('main');

        $pageElementTemplate = new PageElementTemplate(
            $page,
            $template,
            $customAttributes
        );

        $this->assertEquals(
            'main',
            $pageElementTemplate->getPage()->getCode()
        );

        $this->assertEquals(
            '<meta name="description" content="Описание главной страницы раскрыто в этом тексте">',
            $pageElementTemplate->render()
        );
    }

    public function testRequired()
    {
        $template = new Template(
            'Метатег Description',
            new Tag('button', new Type(Type::PAIR)),
            new Required([], true),
            new Attributes([
                'disabled'
            ])
        );

        $customAttributes = new Attributes(['name' => 'sale']);

        $page = new Page('main');

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Обязательно должен быть указан текст элемента');
        $pageElementTemplate = new PageElementTemplate(
            $page,
            $template,
            $customAttributes,
        );
    }
}
