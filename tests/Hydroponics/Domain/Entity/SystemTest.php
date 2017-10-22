<?php

namespace GSoares\Hydroponics\Domain\Entity;

use PHPUnit\Framework\TestCase;

class SystemTest extends TestCase
{
    public function testNewGreenhouseCreated()
    {
        $tank = new Tank('Tank', 1.5);
        $greenhouse = new Greenhouse('greenhouse');
        $system = new System('NFT', $greenhouse, $tank);

        $this->assertEquals($greenhouse, $system->getGreenhouse());
        $this->assertEquals($tank, $system->getTank());
        $this->assertEquals('NFT', $system->getName());
    }
}
