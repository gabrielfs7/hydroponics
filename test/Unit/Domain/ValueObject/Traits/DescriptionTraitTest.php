<?php

namespace GSoares\Hydroponics\Test\Unit\Domain\ValueObject\Traits;

use GSoares\Hydroponics\Domain\ValueObject\Traits\DescriptionTrait;
use PHPUnit\Framework\TestCase;

class DescriptionTraitTest extends TestCase
{
    public function testGetDescription()
    {
        $trait = $this->getMockForTrait(DescriptionTrait::class);
        $trait->changeDescription('Test');

        $this->assertSame('Test', $trait->getDescription());
    }
}
