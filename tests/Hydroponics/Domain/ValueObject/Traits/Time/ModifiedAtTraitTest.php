<?php

namespace GSoares\Hydroponics\Domain\ValueObject\Traits\Time;

use PHPUnit\Framework\TestCase;

class ModifiedAtTraitTest extends TestCase
{
    public function testAllDateModifications()
    {
        $time = new \DateTime('2010-10-10 10:10:10');
        $trait = $this->getMockForTrait('GSoares\Hydroponics\Domain\ValueObject\Traits\Time\ModifiedAtTrait');

        $this->assertEquals($trait, $trait->changeCreatedAt($time));
        $this->assertEquals($time, $trait->getCreatedAt());

        $this->assertEquals($trait, $trait->changeUpdatedAt($time));
        $this->assertEquals($time, $trait->getUpdatedAt());

        $this->assertEquals($trait, $trait->changeDeletedAt($time));
        $this->assertEquals($time, $trait->getDeletedAt());
    }
}
