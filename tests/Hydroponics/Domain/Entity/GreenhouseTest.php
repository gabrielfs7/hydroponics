<?php

namespace GSoares\Hydroponics\Domain\Entity;

use PHPUnit\Framework\TestCase;

class GreenhouseTest extends TestCase
{
    public function testNewGreenhouseCreated()
    {
        $greenhouse = new Greenhouse('greenhouse');

        $this->assertEquals('greenhouse', $greenhouse->getName());
    }
}
