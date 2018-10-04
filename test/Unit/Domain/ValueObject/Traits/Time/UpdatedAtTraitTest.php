<?php

namespace GSoares\Hydroponics\Test\Unit\Domain\ValueObject\Traits\Time;

use GSoares\Hydroponics\Domain\ValueObject\Traits\Time\UpdatedAtTrait;
use PHPUnit\Framework\TestCase;

class UpdatedAtTraitTest extends TestCase
{
    public function testGetCreatedAt()
    {
        $time = new \DateTime('2010-10-10 10:10:10');
        $trait = $this->getMockForTrait(UpdatedAtTrait::class);

        $this->assertEquals($trait, $trait->changeUpdatedAt($time));
        $this->assertEquals($time, $trait->getUpdatedAt());
    }
}
