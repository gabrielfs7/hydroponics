<?php

namespace GSoares\Hydroponics\Test\Unit\Domain\Factory\Crops;

use ArrayObject;
use DateTimeImmutable;
use GSoares\Hydroponics\Domain\Entity\Crops;
use GSoares\Hydroponics\Domain\Entity\Greenhouse;
use GSoares\Hydroponics\Domain\Entity\System;
use GSoares\Hydroponics\Domain\Entity\Tank;
use GSoares\Hydroponics\Domain\Entity\Plant;
use GSoares\Hydroponics\Domain\Factory\Crops\CropsFactory;
use GSoares\Hydroponics\Infrastructure\DateTime\DateTimeProvider;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CropsFactoryTest extends TestCase
{
    /** @var DateTimeProvider|MockObject */
    private $dateTimeProvider;

    /** @var CropsFactory */
    private $factory;

    public function setUp()
    {
        $this->dateTimeProvider = $this->createMock(DateTimeProvider::class);
        $this->factory = new CropsFactory($this->dateTimeProvider);
    }

    public function testMake()
    {
        $currentTime = new DateTimeImmutable();

        $this->dateTimeProvider
            ->expects($this->once())
            ->method('current')
            ->willReturn($currentTime);

        $tank = new Tank('Tank', 1.5, null);
        $system = new System('NFT', new Greenhouse('Vegetables'), $tank);
        $plant = new Plant('Lettuce', 'Lactuca sativa');

        $crops = new Crops('Lettuce Crops', 25, $system, $plant);
        $crops->changeCreatedAt($currentTime);

        $parameters = new ArrayObject(
            [
                'name' => 'Lettuce Crops',
                'quantity' => 25,
                'system' => $system,
                'plant' => $plant,
            ]
        );

        $this->assertEquals($crops, $this->factory->make($parameters));
    }
}
