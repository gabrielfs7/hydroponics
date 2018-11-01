<?php

namespace GSoares\Hydroponics\Test\Functional\Application\Action\Tank;

use DateTimeInterface;
use GSoares\Hydroponics\Domain\Entity\Tank;
use GSoares\Hydroponics\Domain\Entity\TankVersion;
use GSoares\Hydroponics\Domain\Repository\Tank\TankRepository;
use GSoares\Hydroponics\Test\Functional\Application\Action\WebTestCase;
use GSoares\Hydroponics\Test\Mock\TankMock;

class UpdateTankActionTest extends WebTestCase
{
    /** @var TankRepository */
    private $tankRepository;

    public function setUp()
    {
        parent::setUp();

        $this->tankRepository = $this->getContainer()
            ->get(TankRepository::class);
    }

    public function testCanUpdateTankWhenProvidingExistentId() : void
    {
        /** @var Tank $entity */
        $entity = $this->createFixture(Tank::class);

        $this->assertNull($entity->getUpdatedAt());

        $newAttributes = [
            'name' => 'New Name',
            'description' => 'Updated',
            'currentVolume' => 888.88,
            'minVolume' => 99.99,
            'waterTemperature' => 77.77,
            'maxWaterTemperature' => 55.55,
            'minWaterTemperature' => 44.44,
            'waterPh' => 3.33,
            'maxWaterPh' => 8.88,
            'minWaterPh' => 5.55,
            'waterEc' => 3.33,
            'maxWaterEc' => 2.22,
            'minWaterEc' => 1.33,
            'waterDbo' => 4.44,
            'maxWaterDbo' => 6.66,
            'minWaterDbo' => 9.99,
        ];

        $response = $this->runApp(
            'PATCH',
            sprintf('/api/tanks/%s', $entity->getId()),
            TankMock::getPatchRequestBody($newAttributes)
        );

        $entity = $this->tankRepository
            ->addFilter('id', $entity->getId())
            ->findOne();

        /** @var TankVersion $tankVersion */
        $tankVersion = $entity->getLastVersion();

        $this->assertResponseHasStatusCode(200);
        $this->assertResponseHasBody(TankMock::getResponseBody($entity));

        $this->assertSame('New Name', $entity->getName());
        $this->assertSame('Updated', $entity->getDescription());
        $this->assertInstanceOf(DateTimeInterface::class, $entity->getUpdatedAt());
        $this->assertSame($newAttributes['currentVolume'], $tankVersion->getWaterVolume()->getCurrentVolume());
        $this->assertSame($newAttributes['minVolume'], $tankVersion->getWaterVolume()->getMinVolume());
        $this->assertSame($newAttributes['waterTemperature'], $tankVersion->getWaterTemperature()->getTemperature());
        $this->assertSame(
            $newAttributes['maxWaterTemperature'],
            $tankVersion->getWaterTemperature()->getMaxTemperature()
        );
        $this->assertSame(
            $newAttributes['minWaterTemperature'],
            $tankVersion->getWaterTemperature()->getMinTemperature()
        );
        $this->assertSame($newAttributes['waterPh'], $tankVersion->getWaterPh()->getPh());
        $this->assertSame($newAttributes['maxWaterPh'], $tankVersion->getWaterPh()->getMaxPh());
        $this->assertSame($newAttributes['minWaterPh'], $tankVersion->getWaterPh()->getMinPh());
        $this->assertSame($newAttributes['waterEc'], $tankVersion->getWaterEc()->getEc());
        $this->assertSame($newAttributes['maxWaterEc'], $tankVersion->getWaterEc()->getMaxEc());
        $this->assertSame($newAttributes['minWaterEc'], $tankVersion->getWaterEc()->getMinEc());
        $this->assertSame($newAttributes['waterDbo'], $tankVersion->getWaterDbo()->getDbo());
        $this->assertSame($newAttributes['maxWaterDbo'], $tankVersion->getWaterDbo()->getMaxDbo());
        $this->assertSame($newAttributes['minWaterDbo'], $tankVersion->getWaterDbo()->getMinDbo());
    }
}
