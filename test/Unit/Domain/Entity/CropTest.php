<?php

namespace GSoares\Hydroponics\Test\Unit\Domain\Entity;

use GSoares\Hydroponics\Domain\Entity\Crop;
use GSoares\Hydroponics\Domain\Entity\Greenhouse;
use GSoares\Hydroponics\Domain\Entity\Plant;
use GSoares\Hydroponics\Domain\Entity\System;
use GSoares\Hydroponics\Domain\Entity\Tank;
use PHPUnit\Framework\TestCase;

class CropTest extends TestCase
{
    public function testNewCropCreated()
    {
        $tank = new Tank('Tank', 1.5, null);
        $plant = new Plant('Lettuce', 'Lactuca sativa');
        $system = new System('NFT', new Greenhouse('greenhouse'), $tank);
        $crop = new Crop('Lettuce Crop', 25, $system, $plant);

        $this->assertEquals('Lettuce Crop', $crop->getName());
        $this->assertEquals(25, $crop->getQuantity());
        $this->assertEquals($system, $crop->getSystem());
        $this->assertEquals($plant, $crop->getPlant());
    }
}
