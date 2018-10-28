<?php

namespace GSoares\Hydroponics\Test\Unit\Domain\Entity;

use GSoares\Hydroponics\Domain\Entity\NutritionalFormula;
use GSoares\Hydroponics\Domain\Entity\Tank;
use PHPUnit\Framework\TestCase;

class TankTest extends TestCase
{
    public function testNewWaterTankCreated()
    {
        $nutritionalFormula = new NutritionalFormula('Formula');
        $tank = new Tank('Nutrient Tank', 1.5, $nutritionalFormula);

        $this->assertEquals('Nutrient Tank', $tank->getName());
        $this->assertEquals(1.5, $tank->getVolumeCapacity());
        $this->assertEquals($nutritionalFormula, $tank->getNutritionalFormula());
    }

    public function testNewTankCreated()
    {
        $tank = new Tank('Nutrient Tank', 1.5, null);

        $this->assertEquals('Nutrient Tank', $tank->getName());
        $this->assertEquals(1.5, $tank->getVolumeCapacity());
    }
}
