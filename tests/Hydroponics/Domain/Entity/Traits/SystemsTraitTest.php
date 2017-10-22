<?php

namespace GSoares\Hydroponics\Domain\Entity\Traits;

use PHPUnit\Framework\TestCase;

class SystemsTraitTest extends TestCase
{
    public function testAddSystem()
    {
        $systemTrait = $this->getMockForTrait('GSoares\Hydroponics\Domain\Entity\Traits\SystemsTrait');

        $this->assertNull($systemTrait->getSystems());
    }
}
