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
    public function testRender()
    {
        $page = new Page('main');
        $requiredAttributeName = 'content';
        $template = new Template(
            'Метатег Description',
            new Tag('meta', Type::single()),
            new Required([$requiredAttributeName]),
            new Attributes(['name' => 'description']),
        );
        $customAttributes = new Attributes([$requiredAttributeName => 'Описание главной страницы раскрыто в этом тексте']);
        $pageElementTemplate = new PageElementTemplate(
            $page,
            $template,
            $customAttributes
        );

        $this->assertEquals(
            '<meta name="description" content="Описание главной страницы раскрыто в этом тексте">',
            $pageElementTemplate->render()
        );
    }

    public function testRequiredText()
    {
        $page = new Page('main');
        $template = new Template(
            'Метатег Description',
            new Tag('button', Type::pair()),
            new Required([], true),
            new Attributes([
                'disabled'
            ])
        );
        $customAttributes = new Attributes(['name' => 'sale']);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Обязательно должен быть указан текст элемента');
        new PageElementTemplate(
            $page,
            $template,
            $customAttributes,
        );
    }

    public function testRequiredAttribute()
    {
        $page = new Page('main');

        $requiredAttributeName = 'name';
        $template = new Template(
            'Метатег Description',
            new Tag('button', Type::pair()),
            new Required([$requiredAttributeName]),
            new Attributes([
                'disabled'
            ])
        );

        $customAttributes = new Attributes(['noName' => 'sale']);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Атрибут `{$requiredAttributeName}` является обязательным, но не задан");
        new PageElementTemplate(
            $page,
            $template,
            $customAttributes,
        );
    }

    public function testTextForSingleTag()
    {
        $page = new Page('main');

        $requiredAttributeName = 'name';
        $template = new Template(
            'Метатег Description',
            new Tag('button', Type::single()),
            new Required([$requiredAttributeName]),
            new Attributes([
                'disabled'
            ])
        );

        $customAttributes = new Attributes([$requiredAttributeName => 'sale']);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Ошибка: для элемента с одиночным тегом (пустого) не следует задавать текст');
        new PageElementTemplate(
            $page,
            $template,
            $customAttributes,
            'TextForSingleTag'
        );
    }
}
