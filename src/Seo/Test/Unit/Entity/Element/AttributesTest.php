<?php

namespace App\Seo\Test\Unit\Entity\Element;

use App\Seo\Entity\Element\Attributes;
use PHPUnit\Framework\TestCase;

class AttributesTest extends TestCase
{
    public function testSuccess()
    {
        $attributes = new Attributes([
            'name' => 'description',
            'logicalAttribute',
            'otherLogicalAttribute'
        ]);

        $this->assertEquals(
            'name="description" logicalAttribute otherLogicalAttribute',
            $attributes->toString()
        );
    }
}
