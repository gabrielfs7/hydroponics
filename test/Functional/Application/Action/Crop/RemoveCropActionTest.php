<?php

namespace GSoares\Hydroponics\Test\Functional\Application\Action\Crop;

use DateTimeInterface;
use GSoares\Hydroponics\Domain\Entity\Crop;
use GSoares\Hydroponics\Domain\Entity\System;
use GSoares\Hydroponics\Domain\Repository\Crop\CropRepository;
use GSoares\Hydroponics\Test\Functional\Application\Action\WebTestCase;
use GSoares\Hydroponics\Test\Mock\CropMock;

class RemoveCropActionTest extends WebTestCase
{
    /** @var CropRepository */
    private $cropRepository;

    public function setUp()
    {
        parent::setUp();

        $this->cropRepository = $this->getContainer()
            ->get(CropRepository::class);
    }

    public function testCanRemoveSystemWhenProvidingExistentId() : void
    {
        /** @var System $system */
        $system = $this->createFixture(System::class);

        /** @var Crop $entity */
        $entity = $this->createFixture(Crop::class);

        $this->assertNull($entity->getDeletedAt());

        $this->runApp(
            'DELETE',
            sprintf(
                '/api/greenhouses/%s/systems/%s/crops/%s',
                $system->getGreenhouse()->getId(),
                $system->getId(),
                $entity->getId()
            )
        );

        /** @var Crop $entity */
        $entity = $this->cropRepository
            ->addFilter('id', $entity->getId())
            ->findOne();

        $this->assertInstanceOf(DateTimeInterface::class, $entity->getDeletedAt());
        $this->assertResponseHasStatusCode(200);
        $this->assertResponseHasBody(CropMock::getResponseBody($entity));
    }
}
