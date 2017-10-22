<?php

namespace GSoares\Hydroponics\Domain\ValueObject\Traits\Time;

trait DeletedAtTrait
{

    /**
     * @var \DateTime
     */
    protected $deletedAt;

    /**
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }
}
