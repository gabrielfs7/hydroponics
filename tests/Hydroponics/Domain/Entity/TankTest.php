<?php

namespace GSoares\Hydroponics\Domain\Entity;

use GSoares\Hydroponics\Domain\ValueObject\NutritionalFormula;
use PHPUnit\Framework\TestCase;

class TankTest extends TestCase
{
    public function testNewGreenhouseCreated()
    {
        $nutritionalFormula = new NutritionalFormula('Formula');
        $tank = new Tank('Nutrient Tank', 1.5, $nutritionalFormula);

        $this->assertEquals($nutritionalFormula, $tank->getNutritionalFormula());
        $this->assertEquals(1.5, $tank->getVolumeCapacity());
    }
}
