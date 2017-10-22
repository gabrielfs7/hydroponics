<?php

namespace GSoares\Hydroponics\Domain\ValueObject\Traits\Time;

use PHPUnit\Framework\TestCase;

class UpdatedAtTraitTest extends TestCase
{
    public function testGetCreatedAt()
    {
        $time = new \DateTime('2010-10-10 10:10:10');
        $trait = $this->getMockForTrait('GSoares\Hydroponics\Domain\ValueObject\Traits\Time\UpdatedAtTrait');

        $this->assertEquals($trait, $trait->changeUpdatedAt($time));
        $this->assertEquals($time, $trait->getUpdatedAt());
    }
}
