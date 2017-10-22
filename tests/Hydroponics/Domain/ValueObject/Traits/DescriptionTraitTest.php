<?php

namespace GSoares\Hydroponics\Domain\ValueObject\Traits;

use PHPUnit\Framework\TestCase;

class DescriptionTraitTest extends TestCase
{
    public function testGetName()
    {
        $trait = $this->getMockForTrait('GSoares\Hydroponics\Domain\ValueObject\Traits\DescriptionTrait');

        $this->assertNull($trait->getDescription());
    }
}
