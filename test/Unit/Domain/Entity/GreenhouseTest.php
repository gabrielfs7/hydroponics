<?php

namespace GSoares\Hydroponics\Test\Unit\Domain\Entity;

use ArrayAccess;
use GSoares\Hydroponics\Domain\Entity\Greenhouse;
use PHPUnit\Framework\TestCase;

class GreenhouseTest extends TestCase
{
    public function testNewGreenhouseCreated()
    {
        $greenhouse = new Greenhouse('greenhouse');

        $this->assertEquals('greenhouse', $greenhouse->getName());
        $this->assertInstanceOf(ArrayAccess::class, $greenhouse->getSystems());
    }
}
