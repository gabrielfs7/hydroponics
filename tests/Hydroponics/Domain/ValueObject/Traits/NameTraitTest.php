<?php

namespace GSoares\Hydroponics\Domain\ValueObject\Traits;

use PHPUnit\Framework\TestCase;

class NameTraitTest extends TestCase
{
    public function testGetName()
    {
        $trait = $this->getMockForTrait('GSoares\Hydroponics\Domain\ValueObject\Traits\NameTrait');

        $this->assertNull($trait->getName());
    }
}
