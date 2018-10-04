<?php

namespace GSoares\Hydroponics\Test\Unit\Domain\ValueObject\Traits;

use GSoares\Hydroponics\Domain\ValueObject\Traits\IdTrait;
use PHPUnit\Framework\TestCase;

class IdTraitTest extends TestCase
{
    public function testGetId()
    {
        $trait = $this->getMockForTrait(IdTrait::class);

        $this->assertNull($trait->getId());
    }
}
