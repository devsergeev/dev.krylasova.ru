<?php

namespace App\Seo\Test\Unit\Entity;

use App\Seo\Entity\Template\Required;
use PHPUnit\Framework\TestCase;

class RequiredTest extends TestCase
{
    private array $arrayAttributes = ['name' => 'description', 'logicalAttribute', 'otherLogicalAttribute'];
    private bool $textIsRequired = true;
    private string $json = '[{"name":"description","0":"logicalAttribute","1":"otherLogicalAttribute"},true]';

    public function testToJson()
    {
        $required = new Required($this->arrayAttributes, $this->textIsRequired);
        $this->assertEquals($this->json, $required->toJson());
    }

    public function testFromJson()
    {
        $required = Required::fromJson($this->json);
        $this->assertEquals($this->arrayAttributes, $required->getAttributes());
        $this->assertEquals($this->textIsRequired, $required->textIsRequired());
    }
}

