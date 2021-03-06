<?php

namespace GSoares\Hydroponics\Test\Unit\Domain\Entity;

use GSoares\Hydroponics\Domain\Entity\Greenhouse;
use GSoares\Hydroponics\Domain\Entity\System;
use GSoares\Hydroponics\Domain\Entity\Tank;
use PHPUnit\Framework\TestCase;

class SystemTest extends TestCase
{
    public function testNewGreenhouseCreated()
    {
        $tank = new Tank('Tank', 1.5, null);
        $greenhouse = new Greenhouse('greenhouse');
        $system = new System('NFT', $greenhouse, $tank);

        $this->assertEquals($greenhouse, $system->getGreenhouse());
        $this->assertEquals($tank, $system->getTank());
        $this->assertEquals('NFT', $system->getName());
    }
}
