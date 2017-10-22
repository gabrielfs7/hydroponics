<?php

namespace GSoares\Hydroponics\Domain\ValueObject\Traits\Time;

trait UpdatedAtTrait
{

    /**
     * @var \DateTime
     */
    protected $updatedAt;

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
