<?php

namespace GSoares\Hydroponics\Domain\Repository\Tank;

trait TankRepositoryTrait
{
    /** @var  TankRepository */
    private $tankRepository;

    public function getTankRepository(): TankRepository
    {
        return $this->tankRepository;
    }

    public function setTankRepository(TankRepository $tankRepository): self
    {
        $this->tankRepository = $tankRepository;

        return $this;
    }
}
