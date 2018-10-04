<?php

namespace GSoares\Hydroponics\Test\Unit\Domain\ValueObject\Traits\Time;

use DateTime;
use GSoares\Hydroponics\Domain\ValueObject\Traits\Time\CreatedAtTrait;
use PHPUnit\Framework\TestCase;

class CreatedAtTraitTest extends TestCase
{
    public function testGetCreatedAt()
    {
        $time = new DateTime('2010-10-10 10:10:10');
        $trait = $this->getMockForTrait(CreatedAtTrait::class);

        $this->assertEquals($trait, $trait->changeCreatedAt($time));
        $this->assertEquals($time, $trait->getCreatedAt());
    }
}
