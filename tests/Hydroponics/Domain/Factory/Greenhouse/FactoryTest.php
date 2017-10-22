<?php

namespace GSoares\Hydroponics\Domain\Factory\Greenhouse;

use GSoares\Hydroponics\Domain\Entity\Greenhouse;
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

        $greenhouse = new Greenhouse('Fruits');
        $greenhouse->changeCreatedAt($currentTime);

        $this->assertEquals($greenhouse, $this->factory->make('Fruits'));
    }
}
