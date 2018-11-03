<?php

namespace GSoares\Hydroponics\Test\Unit\Domain\Entity;

use GSoares\Hydroponics\Domain\Entity\Crops;
use GSoares\Hydroponics\Domain\Entity\Greenhouse;
use GSoares\Hydroponics\Domain\Entity\Plant;
use GSoares\Hydroponics\Domain\Entity\System;
use GSoares\Hydroponics\Domain\Entity\Tank;
use PHPUnit\Framework\TestCase;

class CropsTest extends TestCase
{
    public function testNewCropsCreated()
    {
        $tank = new Tank('Tank', 1.5, null);
        $plant = new Plant('Lettuce', 'Lactuca sativa');
        $system = new System('NFT', new Greenhouse('greenhouse'), $tank);
        $crops = new Crops('Lettuce Crops', 25, $system, $plant);

        $this->assertEquals('Lettuce Crops', $crops->getName());
        $this->assertEquals(25, $crops->getQuantity());
        $this->assertEquals($system, $crops->getSystem());
        $this->assertEquals($plant, $crops->getPlant());
    }
}
