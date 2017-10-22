<?php

namespace GSoares\Hydroponics\Domain\Factory\System;

use GSoares\Hydroponics\Domain\Entity\Greenhouse;
use GSoares\Hydroponics\Domain\Entity\System;
use GSoares\Hydroponics\Domain\Entity\Tank;
use GSoares\Hydroponics\Infrastructure\DateTime\DateTimeProvider;
use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase
{

    /**
     * @var DateTimeProvider|\PHPUnit_Framework_MockObject_MockObject
     */
    private $dateTimeProvider;

    /**
     * @var Factory
     */
    private $factory;

    public function setUp()
    {
        $this->dateTimeProvider = $this->createMock('GSoares\Hydroponics\Infrastructure\DateTime\DateTimeProvider');
        $this->factory = new Factory($this->dateTimeProvider);
    }

    public function testMake()
    {
        $currentTime = new \DateTime('2010-10-10 10:10:10');

        $dateProvider = $this->dateTimeProvider;
        $invocationMocker = $dateProvider->expects($this->once());

        $invocationMocker->method('current');
        $invocationMocker->willReturn($currentTime);

        $tank = new Tank('Tank', 1.5);
        $greenhouse = new Greenhouse('Fruits');

        $system = new System('Fruits', $greenhouse, $tank);
        $system->changeCreatedAt($currentTime);

        $this->assertEquals($system, $this->factory->make('Fruits', $greenhouse, $tank));
    }
}
