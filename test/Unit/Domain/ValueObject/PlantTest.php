<?php

namespace GSoares\Hydroponics\Test\Unit\Domain\ValueObject;

use GSoares\Hydroponics\Domain\Entity\Plant;
use PHPUnit\Framework\TestCase;

class PlantTest extends TestCase
{
    public function testNewGreenhouseCreated()
    {
        $plant = new Plant('Lettuce', 'Lactuca sativa');

        $this->assertEquals('Lettuce', $plant->getName());
        $this->assertEquals('Lactuca sativa', $plant->getSpecies());
    }
}
