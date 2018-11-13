<?php

namespace GSoares\Hydroponics\Test\Functional\Application\Action\System;

use GSoares\Hydroponics\Domain\Entity\NutritionalFormula;
use GSoares\Hydroponics\Domain\Entity\Tank;
use GSoares\Hydroponics\Domain\Repository\Tank\TankRepository;
use GSoares\Hydroponics\Test\Functional\Application\Action\WebTestCase;
use GSoares\Hydroponics\Test\Mock\TankMock;

class CreateTankActionTest extends WebTestCase
{
    /** @var TankRepository */
    private $tankRepository;

    public function setUp()
    {
        parent::setUp();

        $this->tankRepository = $this->getContainer()
            ->get(TankRepository::class);
    }

    public function testCreateATankWhenProvidingCorrectRequest(): void
    {
        $this->assertCount(0, $this->tankRepository->findAll());

        /** @var NutritionalFormula $nutritionalFormula */
        $nutritionalFormula = $this->createFixture(NutritionalFormula::class);

        $this->runApp(
            'POST',
            '/api/tanks',
            TankMock::getPostRequestBody($nutritionalFormula->getId())
        );

        /** @var Tank $entity */
        $entity = $this->tankRepository
            ->findOne();

        $this->assertResponseHasStatusCode(200);
        $this->assertResponseHasBody(TankMock::getResponseBody($entity));
    }
}
