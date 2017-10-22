<?php

namespace GSoares\Hydroponics\Domain\ValueObject\Traits;

use PHPUnit\Framework\TestCase;

class IdTraitTest extends TestCase
{
    public function testAddSystem()
    {
        $idTrait = $this->getMockForTrait('GSoares\Hydroponics\Domain\ValueObject\Traits\IdTrait');

        $this->assertNull($idTrait->getId());
    }
}
