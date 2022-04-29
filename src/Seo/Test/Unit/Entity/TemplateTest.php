<?php

namespace App\Seo\Test\Unit\Entity;

use App\Seo\Entity\Attributes;
use App\Seo\Entity\Tag\Tag;
use App\Seo\Entity\Tag\Type;
use App\Seo\Entity\Template\Required;
use App\Seo\Entity\Template\Template;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class TemplateTest extends TestCase
{
    public function testTextForSingleTag()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Ошибка: для элемента с одиночным тегом (пустого) не следует задавать текст');
        new Template(
            'Метатег Description',
            new Tag('meta', Type::single()),
            new Required(['content']),
            new Attributes(['name' => 'description']),
            'TextForSingleTag'
        );
    }
}
