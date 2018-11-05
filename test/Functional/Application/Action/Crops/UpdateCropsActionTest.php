<?php

namespace GSoares\Hydroponics\Test\Functional\Application\Action\Crops;

use DateTimeImmutable;
use DateTimeInterface;
use GSoares\Hydroponics\Domain\Entity\Crops;
use GSoares\Hydroponics\Domain\Entity\System;
use GSoares\Hydroponics\Domain\Repository\Crops\CropsRepository;
use GSoares\Hydroponics\Test\Functional\Application\Action\WebTestCase;
use GSoares\Hydroponics\Test\Mock\CropsMock;

class UpdateCropsActionTest extends WebTestCase
{
    /** @var CropsRepository */
    private $cropsRepository;

    public function setUp()
    {
        parent::setUp();

        $this->cropsRepository = $this->getContainer()
            ->get(CropsRepository::class);
    }

    public function testCanUpdateCropsWhenProvidingExistentId() : void
    {
        /** @var System $otherSystem */
        $otherSystem = $this->createFixture(System::class);

        /** @var Crops $entity */
        $entity = $this->createFixture(Crops::class);

        $this->assertNull($entity->getUpdatedAt());
        $this->assertNull($entity->getHarvestedAt());

        $harvestedAt = new DateTimeImmutable();

        $this->runApp(
            'PATCH',
            sprintf(
                '/api/greenhouses/%s/systems/%s/crops/%s',
                $entity->getSystem()->getGreenhouse()->getId(),
                $entity->getSystem()->getId(),
                $entity->getId()
            ),
            CropsMock::getPatchRequestBody(
                [
                    'name' => 'Test updated',
                    'quantity' => 900,
                    'quantityHarvested' => 800,
                    'quantityLost' => 100,
                    'harvestedAt' => $harvestedAt->format(DATE_ATOM),
                    'systemId' => $otherSystem->getId()
                ]
            )
        );

        /** @var Crops $entity */
        $entity = $this->cropsRepository
            ->addFilter('id', $entity->getId())
            ->findOne();

        $this->assertSame('Test updated', $entity->getName());
        $this->assertSame(900, $entity->getQuantity());
        $this->assertSame(800, $entity->getQuantityHarvested());
        $this->assertSame(100, $entity->getQuantityLost());
        //FIXME $this->assertEquals($otherSystem, $entity->getSystem());
        $this->assertInstanceOf(DateTimeInterface::class, $entity->getUpdatedAt());
        $this->assertResponseHasStatusCode(200);
        $this->assertResponseHasBody(CropsMock::getResponseBody($entity));
    }
}
