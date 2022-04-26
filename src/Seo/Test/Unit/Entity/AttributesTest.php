<?php

namespace App\Seo\Test\Unit\Entity;

use App\Seo\Entity\Attributes;
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
            ' name="description" logicalAttribute otherLogicalAttribute',
            $attributes->render()
        );
    }
}
