<?php

namespace GSoares\Hydroponics\Domain\ValueObject\Traits\Time;

use PHPUnit\Framework\TestCase;

class CreatedAtTraitTest extends TestCase
{
    public function testGetCreatedAt()
    {
        $time = new \DateTime('2010-10-10 10:10:10');
        $trait = $this->getMockForTrait('GSoares\Hydroponics\Domain\ValueObject\Traits\Time\CreatedAtTrait');

        $this->assertEquals($trait, $trait->changeCreatedAt($time));
        $this->assertEquals($time, $trait->getCreatedAt());
    }
}
