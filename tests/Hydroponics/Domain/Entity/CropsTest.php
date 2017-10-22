<?php

namespace GSoares\Hydroponics\Domain\Entity;

use GSoares\Hydroponics\Domain\ValueObject\Plant;
use PHPUnit\Framework\TestCase;

class CropsTest extends TestCase
{
    public function testNewCropsCreated()
    {
        $tank = new Tank('Tank', 1.5);
        $plant = new Plant('Lettuce', 'Lactuca sativa');
        $greenhouse = new Greenhouse('greenhouse');
        $system = new System('NFT', $greenhouse, $tank);
        $crops = new Crops('Lettuce Crops', $system, $plant);

        $this->assertEquals('Lettuce Crops', $crops->getName());
        $this->assertEquals($system, $crops->getSystem());
        $this->assertEquals($plant, $crops->getPlant());
    }
}
