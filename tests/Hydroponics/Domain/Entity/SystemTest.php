<?php

namespace GSoares\Hydroponics\Domain\Entity;

use PHPUnit\Framework\TestCase;

class SystemTest extends TestCase
{
    public function testNewGreenhouseCreated()
    {
        $greenhouse = new Greenhouse('greenhouse');
        $system = new System('NFT', $greenhouse);

        $this->assertEquals($greenhouse, $system->getGreenhouse());
        $this->assertEquals('NFT', $system->getName());
    }
}
