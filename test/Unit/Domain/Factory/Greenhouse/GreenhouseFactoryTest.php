<?php

namespace GSoares\Hydroponics\Test\Unit\Domain\Factory\Greenhouse;

use ArrayObject;
use GSoares\Hydroponics\Domain\Entity\Greenhouse;
use GSoares\Hydroponics\Domain\Factory\Greenhouse\GreenhouseFactory;
use GSoares\Hydroponics\Infrastructure\DateTime\DateTimeProvider;
use PHPUnit\Framework\TestCase;

class GreenhouseFactoryTest extends TestCase
{

    /**
     * @var DateTimeProvider|\PHPUnit_Framework_MockObject_MockObject
     */
    private $dateTimeProvider;

    /**
     * @var GreenhouseFactory
     */
    private $factory;

    public function setUp()
    {
        $this->dateTimeProvider = $this->createMock(DateTimeProvider::class);
        $this->factory = new GreenhouseFactory($this->dateTimeProvider);
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

        $this->assertEquals($greenhouse, $this->factory->make(new ArrayObject(['name' => 'Fruits'])));
    }
}
