<?php

namespace GSoares\Hydroponics\Test\Functional\Application\Action\Crop;

use DateTimeImmutable;
use DateTimeInterface;
use GSoares\Hydroponics\Domain\Entity\Crop;
use GSoares\Hydroponics\Domain\Entity\System;
use GSoares\Hydroponics\Domain\Repository\Crop\CropRepository;
use GSoares\Hydroponics\Test\Functional\Application\Action\WebTestCase;
use GSoares\Hydroponics\Test\Mock\CropMock;

class UpdateCropActionTest extends WebTestCase
{
    /** @var CropRepository */
    private $cropRepository;

    public function setUp()
    {
        parent::setUp();

        $this->cropRepository = $this->getContainer()
            ->get(CropRepository::class);
    }

    public function testCanUpdateCropWhenProvidingExistentId() : void
    {
        /** @var System $otherSystem */
        $otherSystem = $this->createFixture(System::class);

        /** @var Crop $entity */
        $entity = $this->createFixture(Crop::class);

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
            CropMock::getPatchRequestBody(
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

        /** @var Crop $entity */
        $entity = $this->cropRepository
            ->addFilter('id', $entity->getId())
            ->findOne();

        $this->assertSame('Test updated', $entity->getName());
        $this->assertSame(900, $entity->getQuantity());
        $this->assertSame(800, $entity->getQuantityHarvested());
        $this->assertSame(100, $entity->getQuantityLost());
        //FIXME $this->assertEquals($otherSystem, $entity->getSystem());
        $this->assertInstanceOf(DateTimeInterface::class, $entity->getUpdatedAt());
        $this->assertResponseHasStatusCode(200);
        $this->assertResponseHasBody(CropMock::getResponseBody($entity));
    }
}
