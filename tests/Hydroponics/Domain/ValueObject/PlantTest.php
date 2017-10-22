<?php

namespace GSoares\Hydroponics\Domain\ValueObject;

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
