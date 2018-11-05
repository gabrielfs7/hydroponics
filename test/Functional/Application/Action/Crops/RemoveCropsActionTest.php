<?php

namespace GSoares\Hydroponics\Test\Functional\Application\Action\Crops;

use DateTimeInterface;
use GSoares\Hydroponics\Domain\Entity\Crops;
use GSoares\Hydroponics\Domain\Entity\System;
use GSoares\Hydroponics\Domain\Repository\Crops\CropsRepository;
use GSoares\Hydroponics\Test\Functional\Application\Action\WebTestCase;
use GSoares\Hydroponics\Test\Mock\CropsMock;

class RemoveCropsActionTest extends WebTestCase
{
    /** @var CropsRepository */
    private $cropsRepository;

    public function setUp()
    {
        parent::setUp();

        $this->cropsRepository = $this->getContainer()
            ->get(CropsRepository::class);
    }

    public function testCanRemoveSystemWhenProvidingExistentId() : void
    {
        /** @var System $system */
        $system = $this->createFixture(System::class);

        /** @var Crops $entity */
        $entity = $this->createFixture(Crops::class);

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

        /** @var Crops $entity */
        $entity = $this->cropsRepository
            ->addFilter('id', $entity->getId())
            ->findOne();

        $this->assertInstanceOf(DateTimeInterface::class, $entity->getDeletedAt());
        $this->assertResponseHasStatusCode(200);
        $this->assertResponseHasBody(CropsMock::getResponseBody($entity));
    }
}
