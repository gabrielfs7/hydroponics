<?php

namespace GSoares\Hydroponics\Test\Unit\Domain\ValueObject\Traits;

use GSoares\Hydroponics\Domain\ValueObject\Traits\DescriptionTrait;
use PHPUnit\Framework\TestCase;

class DescriptionTraitTest extends TestCase
{
    public function testGetName()
    {
        $trait = $this->getMockForTrait(DescriptionTrait::class);

        $this->assertNull($trait->getDescription());
    }
}
