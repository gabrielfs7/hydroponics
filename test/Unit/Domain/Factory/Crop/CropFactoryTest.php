<?php

namespace GSoares\Hydroponics\Test\Unit\Domain\Factory\Crop;

use ArrayObject;
use DateTimeImmutable;
use GSoares\Hydroponics\Domain\Entity\Crop;
use GSoares\Hydroponics\Domain\Entity\Greenhouse;
use GSoares\Hydroponics\Domain\Entity\System;
use GSoares\Hydroponics\Domain\Entity\Tank;
use GSoares\Hydroponics\Domain\Entity\Plant;
use GSoares\Hydroponics\Domain\Factory\Crop\CropFactory;
use GSoares\Hydroponics\Infrastructure\DateTime\DateTimeProvider;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CropFactoryTest extends TestCase
{
    /** @var DateTimeProvider|MockObject */
    private $dateTimeProvider;

    /** @var CropFactory */
    private $factory;

    public function setUp()
    {
        $this->dateTimeProvider = $this->createMock(DateTimeProvider::class);
        $this->factory = new CropFactory($this->dateTimeProvider);
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

        $crop = new Crop('Lettuce Crop', 25, $system, $plant);
        $crop->changeCreatedAt($currentTime);

        $parameters = new ArrayObject(
            [
                'name' => 'Lettuce Crop',
                'quantity' => 25,
                'system' => $system,
                'plant' => $plant,
            ]
        );

        $this->assertEquals($crop, $this->factory->make($parameters));
    }
}
