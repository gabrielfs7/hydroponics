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

    /**
     * @param \DateTime $deletedAt
     * @return $this
     */
    public function changeDeletedAt(\DateTime $deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isDeleted()
    {
        return boolval($this->deletedAt);
    }
}
