<?php

namespace GSoares\Hydroponics\Domain\ValueObject\Traits;

use PHPUnit\Framework\TestCase;

class NameTraitTest extends TestCase
{
    public function testAddSystem()
    {
        $nameTrait = $this->getMockForTrait('GSoares\Hydroponics\Domain\ValueObject\Traits\NameTrait');

        $this->assertNull($nameTrait->getName());
    }
}
