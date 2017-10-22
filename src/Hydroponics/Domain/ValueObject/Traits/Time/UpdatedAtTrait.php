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

    /**
     * @param \DateTime $updatedAt
     * @return $this
     */
    public function changeUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
