<?php

namespace GSoares\Hydroponics\Test\Unit\Domain\Entity\Traits;

use GSoares\Hydroponics\Domain\Entity\Traits\SystemsTrait;
use PHPUnit\Framework\TestCase;

class SystemsTraitTest extends TestCase
{
    public function testAddSystem()
    {
        $systemTrait = $this->getMockForTrait(SystemsTrait::class);

        $this->assertNull($systemTrait->getSystems());
    }
}
