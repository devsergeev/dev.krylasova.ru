<?php

namespace App\Seo\Test\Unit\Entity;

use App\Seo\Entity\ElementTemplate;
use App\Seo\Entity\Page;
use App\Seo\Entity\PageElement\Element\Options\Options;
use App\Seo\Entity\PageElement\PageElement;
use App\Seo\Entity\Tag\Tag;
use App\Seo\Entity\Tag\Type;
use PHPUnit\Framework\TestCase;

class ElementTemplateTest extends TestCase
{
    public function testSuccess()
    {
        $tag = new Tag('meta', new Type(Type::SINGLE));
        $defaultOptions = new Options(['attributeMap' => ['name' => 'description']]);
        $requiredOptions = new Options(['attributeMap' => ['content' => true]]);
        $elementTemplate = new ElementTemplate($tag, $defaultOptions, $requiredOptions);

        $page = new Page('main');
        $customOptions = new Options(['attributeMap' => ['content' => 'Описание гланой страницы раскрыто в этом тексте']]);

        $pageElement = new PageElement($page, $elementTemplate, $customOptions);

        $this->assertEquals(
            '<meta name="description" content="Описание гланой страницы раскрыто в этом тексте">',
            $pageElement->render()
        );
    }
}
