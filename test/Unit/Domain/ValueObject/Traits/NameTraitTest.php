<?php

namespace GSoares\Hydroponics\Test\Unit\Domain\ValueObject\Traits;

use GSoares\Hydroponics\Domain\ValueObject\Traits\NameTrait;
use PHPUnit\Framework\TestCase;

class NameTraitTest extends TestCase
{
    public function testGetName()
    {
        $trait = $this->getMockForTrait(NameTrait::class);
        $trait->changeName('Test');

        $this->assertSame('Test', $trait->getName());
    }
}
