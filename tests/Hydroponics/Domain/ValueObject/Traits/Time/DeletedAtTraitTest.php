<?php

namespace GSoares\Hydroponics\Domain\ValueObject\Traits\Time;

use PHPUnit\Framework\TestCase;

class DeletedAtTraitTest extends TestCase
{
    public function testGetCreatedAt()
    {
        $time = new \DateTime('2010-10-10 10:10:10');
        $trait = $this->getMockForTrait('GSoares\Hydroponics\Domain\ValueObject\Traits\Time\DeletedAtTrait');

        $this->assertFalse($trait->isDeleted());
        $this->assertEquals($trait, $trait->changeDeletedAt($time));
        $this->assertEquals($time, $trait->getDeletedAt());
        $this->assertTrue($trait->isDeleted());
    }
}
