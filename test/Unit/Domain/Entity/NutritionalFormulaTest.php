<?php

namespace GSoares\Hydroponics\Test\Unit\Domain\Entity;

use GSoares\Hydroponics\Domain\Entity\NutritionalFormula;
use PHPUnit\Framework\TestCase;

class NutritionalFormulaTest extends TestCase
{
    public function testNewNutrientCreated()
    {
        $nutrientFormula = new NutritionalFormula('Formula name');
        $nutrientFormula->changeDescription('description');

        $this->assertEquals('Formula name', $nutrientFormula->getName());
        $this->assertEquals('description', $nutrientFormula->getDescription());
    }
}
