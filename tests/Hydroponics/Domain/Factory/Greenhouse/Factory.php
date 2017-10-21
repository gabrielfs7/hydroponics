<?php

namespace GSoares\Hydroponics\Domain\Factory\Greenhouse;

use GSoares\Hydroponics\Domain\Entity\Greenhouse;
use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase
{

    /**
     * @var Factory
     */
    private $factory;

    public function setUp()
    {
        $this->factory = new Factory();
    }

    public function testMake()
    {
        $greenhouse = new Greenhouse('Fruits');

        $this->assertEquals($greenhouse, $this->factory->make('Fruits'));
    }
}
