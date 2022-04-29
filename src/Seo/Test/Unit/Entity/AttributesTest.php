<?php

namespace App\Seo\Test\Unit\Entity;

use App\Seo\Entity\Attributes;
use PHPUnit\Framework\TestCase;

class AttributesTest extends TestCase
{
    public function testToArray()
    {
        $arrayAttributes = ['name' => 'description', 'logicalAttribute', 'otherLogicalAttribute'];
        $attributes = new Attributes($arrayAttributes);
        $this->assertEquals($arrayAttributes, $attributes->toArray());
    }

    public function testToJson()
    {
        $raw = ['name' => 'description', 'logicalAttribute', 'otherLogicalAttribute'];
        $attributes = new Attributes($raw);
        $this->assertEquals(
            '{"name":"description","0":"logicalAttribute","1":"otherLogicalAttribute"}',
            $attributes->toJson()
        );
    }

    public function testHasAttribute()
    {
        $attributes = new Attributes(['name' => 'description']);
        $this->assertTrue($attributes->hasAttribute('name'));
    }

    public function testNotHasAttribute()
    {
        $attributes = new Attributes(['name' => 'description']);
        $this->assertFalse($attributes->hasAttribute('notHasAttribute'));
    }

    public function testRender()
    {
        $attributes = new Attributes(['name' => 'description', 'logicalAttribute', 'otherLogicalAttribute']);
        $this->assertEquals(' name="description" logicalAttribute otherLogicalAttribute', $attributes->render());
    }
}
