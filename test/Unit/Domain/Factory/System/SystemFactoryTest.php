<?php

namespace GSoares\Hydroponics\Test\Unit\Domain\Factory\System;

use ArrayObject;
use DateTime;
use GSoares\Hydroponics\Domain\Entity\Greenhouse;
use GSoares\Hydroponics\Domain\Entity\System;
use GSoares\Hydroponics\Domain\Entity\Tank;
use GSoares\Hydroponics\Domain\Factory\System\SystemFactory;
use GSoares\Hydroponics\Infrastructure\DateTime\DateTimeProvider;
use PHPUnit\Framework\TestCase;

class SystemFactoryTest extends TestCase
{

    /**
     * @var DateTimeProvider|\PHPUnit_Framework_MockObject_MockObject
     */
    private $dateTimeProvider;

    /**
     * @var SystemFactory
     */
    private $factory;

    public function setUp()
    {
        $this->dateTimeProvider = $this->createMock(DateTimeProvider::class);
        $this->factory = new SystemFactory($this->dateTimeProvider);
    }

    public function testMake()
    {
        $currentTime = new DateTime('2010-10-10 10:10:10');

        $dateProvider = $this->dateTimeProvider;
        $invocationMocker = $dateProvider->expects($this->once());

        $invocationMocker->method('current');
        $invocationMocker->willReturn($currentTime);

        $tank = new Tank('Tank', 1.5);
        $greenhouse = new Greenhouse('Fruits');

        $system = new System('Fruits', $greenhouse, $tank);
        $system->changeCreatedAt($currentTime);

        $this->assertEquals(
            $system,
            $this->factory->make(
                new ArrayObject(
                    [
                        'name' => 'Fruits',
                        'greenhouse' => $greenhouse,
                        'tank' => $tank
                    ]
                )
            )
        );
    }
}
